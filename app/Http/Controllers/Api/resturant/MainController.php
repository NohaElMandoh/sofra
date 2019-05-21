<?php

namespace App\Http\Controllers\Api\resturant;

use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Product;

class MainController extends Controller
{
    //resturant info
    public function resturant_info(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'resturant_id' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $resturant_info = Resturant::find($request->resturant_id);

        return responseJson(1,'تم التحميل',$resturant_info->load('hasCategory','neighborhood.city','deliveryway'));
    }
    //add item
    public function add_product(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'preparation_time' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $add_product = $request->user()->products()->create($request->all());

        if ($request->hasFile('product_img')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurants/products/'; // upload path
            $logo = $request->file('product_img');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $add_product->update(['product_img' => 'uploads/restaurants/products/' . $name]);
        }
        return responseJson(1,'تم التحميل',$add_product->load('resturant'));
    }
    //all products
    public function all_products(Request $request)
    {
        $products = $request->user()->products()->latest()->paginate(20);
        return responseJson(1,'تم التحميل',$products);
    }
    //edit item
    public function edit_product(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'preparation_time' => 'required',
            'product_id'=> 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $product = $request->user()->products()->find($request->product_id);
        if ($product)
        {
            $product->update($request->all());


        }else return responseJson(0,'المنتج غير متوفر');

        if ($request->hasFile('product_img')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurants/products/'; // upload path
            $logo = $request->file('product_img');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $product->update(['product_img' => 'uploads/restaurants/products/' . $name]);
        }
        return responseJson(1,'تم التعديل',$product->load('resturant'));
    }
    //add offer
    public function add_offer(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $add_offer = $request->user()->make_offer()->create($request->all());

        if ($request->hasFile('img')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurants/offers/'; // upload path
            $logo = $request->file('img');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $add_offer->update(['img' => 'uploads/restaurants/offers/' . $name]);
        }
        return responseJson(1,'تم التحميل',$add_offer->load('resturant'));
    }
    //all offers
    public function all_offers(Request $request)
    {
        $offers = $request->user()->make_offer()->latest()->paginate(20);
        return responseJson(1,'تم التحميل',$offers);
    }

}
