<?php

namespace App\Http\Controllers\Api\client;

use App\Mail\resetpassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'neighborhood_id' => 'required',
            'adderss_desc' => 'required',
            'email' => 'required|unique:clients,email',
            'password' => 'required|confirmed'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $userToken = str_random(60);
        $request->merge(array('api_token' => $userToken));
        $request->merge(array('password' => bcrypt($request->password)));
        $user = Client::create($request->all());
        if ($user) {
            $data = [
                'api_token' => $userToken,
                'user' => $user->load('neighborhood.city')
            ];

            return responseJson(1,'تم التسجيل بنجاح',$data);
        } else {
            return responseJson(0,'حدث خطأ ، حاول مرة أخرى');
        }
    }
    public function login(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $user = Client::where('email', $request->input('email'))->first();
        if ($user)
        {
            if (Hash::check($request->password, $user->password))
            {
                $data = [
                    'api_token' => $user->api_token,
                    'user' => $user->load('neighborhood.city'),
                ];
                return responseJson(1,'تم تسجيل الدخول',$data);
            }else{
                return responseJson(0,'بيانات الدخول غير صحيحة');
            }
        }else{
            return responseJson(0,'بيانات الدخول غير صحيحة');
        }
    }
    public function profile(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'password' => 'confirmed',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        if ($request->has('name')) {
            $request->user()->update($request->only('name'));
        }
        if ($request->has('email')) {
            $request->user()->update($request->only('email'));
        }
        if ($request->has('password')) {
            $request->merge(array('password' => bcrypt($request->password)));
            $request->user()->update($request->only('password'));
        }

        if ($request->has('phone')) {
            $request->user()->update($request->only('phone'));
        }

        if ($request->has('region_id')) {
            $request->user()->update($request->only('region_id'));
        }

        if ($request->has('address')) {
            $request->user()->update($request->only('address'));
        }

        $data = [
            'user' => $request->user()->load('city')
        ];
        return responseJson(1,'تم تحديث البيانات',$data);
    }
    public function reset(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $user = Client::where('email',$request->email)->first();
        if ($user){
            $code = rand(111111,999999);
            $update = $user->update(['code' => $code]);
            if ($update)
            {

                Mail::to($user->email)
                    ->bcc("nohamelmandoh@gmail")
                    ->send(new resetpassword($code));

                return responseJson(1,'email sent');
            }else{
                return responseJson(0,'error,,,try again');
            }
        }else{
            return responseJson(0,'ensure email please');
        }
    }
    public function check_code(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'code' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $client =  Client::where('code',$request->code)->where('code','!=',0)->first();

        if ($client)
        {

            return responseJson(1,'code valid',[$client]);

        }else{
            return responseJson(0,'code not valid');
        }

    }
    public function update_password(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'client_id'=>'required',
            'password' => 'confirmed'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $client = Client::find($request->client_id);

        if ($client)
        {
            $update_client = $client->update(['password' => bcrypt($request->password), 'code' => null]);
            if ($update_client)
            {
                return responseJson(1,'password changed');
            }else{
                return responseJson(0,'faild, try again');
            }
        }else{
            return responseJson(0,'error');
        }
    }

}
