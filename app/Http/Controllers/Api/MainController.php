<?php

namespace App\Http\Controllers\Api;

use App\Models\AppSettings;
use App\Models\Neighborhood;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactUs;

class MainController extends Controller
{
    public function cities(Request $request)
    {
        $cities = City::where(function($q) use($request){
            if ($request->has('name')){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })->get();
        return responseJson(1,'تم التحميل',$cities);
    }
    public function neighborhoods(Request $request)
    {
        $neighborhoods = Neighborhood::where(function($q) use($request){
            if ($request->has('name')){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })->get();
        return responseJson(1,'تم التحميل',$neighborhoods);
    }
    //get all neighborhoods according to city
    public function neighborhoods_to_city(Request $request)
    {
        $neighborhoods = Neighborhood::where(function($q) use($request){
            if ($request->has('city_id')){
                $q->where('city_id','LIKE','%'.$request->city_id.'%');
            }
        })->get();
        return responseJson(1,'تم التحميل',$neighborhoods);
    }
    //all resturants
    public function resturants(Request $request)
    {
//        if ($request->has('city')){
//            $city = City::where('name',$request->city)->get();
//            // return responseJson(1,'تم التحميل', $city->id);  //Property [id] does not exist on this collection instance.
//            $arrays =(array)$city->toArray();
//            for ($i = 0; $i < count($arrays);$i++) {
//                $q=City::find($arrays[$i]['id']);
//                $q->load('has_neighbor.resturants');
//                    return responseJson(1,'تم التحميل', $q);
//            }
//
//        }

        $resturants = Resturant::where(function($q) use($request){
            //search restaurant id
            if ($request->has('resturant_id')){
                $q->find($request->resturant_id);
            }
            //search restaurant name
            if ($request->has('name')){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
            //search by city name
            if ($request->has('city')){
                $city = City::where('name',$request->city)->get();
                // return responseJson(1,'تم التحميل', $city->id);  //Property [id] does not exist on this collection instance.
                $arrays =(array)$city->toArray();
                for ($i = 0; $i < count($arrays);$i++) {
                    $q=City::find($arrays[$i]['id']);
                    $q->load('has_neighbor.resturants');
//                    return responseJson(1,'تم التحميل', $q);
                }

            }

        })->get();

        return responseJson(1,'تم التحميل',$resturants->load('neighborhood.city','hasCategory'));
    }
//resturant products
    public function restaurant_products(Request $request)
    {
        $products = Product::where('resturant_id',$request->resturant_id)->latest()->paginate(20);
        return responseJson(1,'تم التحميل',$products);
    }
    //about
    public function about(Request $request)
    {
        $settings = AppSettings::find(1);

        if ($settings) {
            return responseJson(1, 'تم التحميل', $settings);
        }

    }
    //contact_us
    public function contact_us(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'msg' => 'required',
            'msg_category' => 'required|in:inquiry,suggestion,complaint',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $sendmsg= ContactUs::create($request->all());


        return responseJson(1,'تم التحميل',$sendmsg);
    }

}
