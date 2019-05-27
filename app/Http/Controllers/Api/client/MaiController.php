<?php

namespace App\Http\Controllers\Api\client;

use App\Models\Order;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaiController extends Controller
{
    //
    public function new_order(Request $request)
    {
//        info(json_encode($request->all()));
        $validation = validator()->make($request->all(), [
            'resturant_id' => 'required|exists:resturants,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.count' => 'required',
            'address' => 'required',
            'payment_method_id' => 'required|exists:payment_methods,id',
//            'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $resturant = Resturant::find($request->resturant_id);
        // restaurant status == '0' => closed
    if($resturant->status == '0')
    {
        return responseJson(0,'عذرا المطعم غير متاح في الوقت الحالي');
    }

//        'cost', 'delivery_cost', 'total', 'commission','net', 'need_delivery_at',
//        'delivery_time_id', 'delivered_at'

        // client
        // set defaults

//         'delivery_time', 'delivery_date'
// 'total_price', 'delivery_status_resturant',  'delivery_status_client',
//, 'delivery_address', 'notes', 'payment_method_id')'status',;

        $order = $request->user()->make_order()->create([
            'resturant_id' => $request->resturant_id,
            'notes' => $request->note,
            'state' => 'pending', // db default
            'delivery_address' => $request->address,
            'payment_method_id' => $request->payment_method_id,
            'status'=>0
        ]);
//
        $cost = 0;
        $delivery_cost = $resturant->delivery_fee;
        foreach ($request->products as $i)
        {
            // ['item_id' => 1,'quantity' => 2,'note'=>'no tomato']
            $product = Product::find($i['product_id']);
            // item validation // no logic
            $readyItem = [
                $i['product_id'] => [
                    'count' => $i['count'],
                    'total_price' => $product->price,
                    'special_order' => (isset($i['special_order'])) ? $i['special_order'] : ''
                ]
            ];
            $order->products()->attach($readyItem);
            $cost += ($product->price * $i['count']);
        }



    }

    public function my_orders(Request $request)
    {
        $orders = $request->user()->make_order()->where(function($order) use($request){
            if ($request->has('state') && $request->state == 'completed')
            {
                $order->where('state' , '!=' , 'pending');
            }elseif ($request->has('state') && $request->state == 'current')
            {
                $order->where('state' , '=' , 'pending');
            }
        })->with('resturant','products')->latest()->paginate(20);
        return responseJson(1,'تم التحميل',$orders);
    }

    public function order_details(Request $request)
    {
        $order= Order::with('resturant','products')->find($request->order_id);
        return responseJson(1,'تم التحميل',$order);
    }
    public function reject_order(Request $request)
    {
        $order= $request->user()->make_order()->find($request->order_id);
        if (!$order)
        {
            return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
        }
        if ($order->status == '0')
        {
            return responseJson(1,'تم رفض الطلب');
        }
        $order->update(['delivery_status_client' => '0']);

        return responseJson(1,'تم رفض الطلب');
    }

    public function confirm_order(Request $request)
    {
        $order = $request->user()->make_order()->find($request->order_id);
        if (!$order)
        {
            return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
        }
        if ($order->status ='2')
        {
            return responseJson(0,'لا يمكن تأكيد الطلب ، لم يتم قبول الطلب');
        }
        $order->update(['delivery_status_client' => '1']);

        return responseJson(1,'تم تأكيد الاستلام');
    }
}
