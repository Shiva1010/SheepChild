<?php

namespace App\Http\Controllers;

//use App\Base;
use App\Sheep;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
        public function userbuy(request $request)
        {

            $userID = $request['sheep_email'];
            $key = $request['key'];
            $shop_account = 'arcadia@camp.com';
            $amount = 300;


//            if (env('pass_status')) {



                $http = new Client();
                $response = $http->post('https://c1b4390d.ngrok.io/api/user/transfer',
                ['form_params'=>[
                    'userID' => $userID,
                    'key' => $key,
                    'account' => $shop_account,
                    'amount' => $amount,
                    ]]);

                return $response->getBody();

//            }else {

//                $msg = Base::get();


//                return response()->json(['msg' => 'done']);

//            }
        }


    public function SheepBaseBalance(request $request)
    {

        $userID = $request['sheep_email'];
        $key = $request['key'];


//            if (env('pass_status')) {



        $http = new Client();
        $response = $http->post('https://c1b4390d.ngrok.ioo/api/user/watch',
            ['form_params'=>[
                'userID' => $userID,
                'key' => $key,
                ]]);

        return $response->getBody();

//            }else {

//                $msg = Base::get();


//                return response()->json(['msg' => 'done']);

//            }
    }

    public function SheepSaveMoney(request $request)
    {


        $userID = $request['sheep_email'];
        $key = $request['key'];
        $amount =$request['amount'];

        $sheep_id=Auth::user()->id;

        $sheep=Sheep::where('id',$sheep_id)->first();

        $balance=$sheep->balance;

        $last_balance = $balance - $amount;

        $sheep->update(['balance'=>$last_balance]);

        $sheep_data=Sheep::where('id',$sheep_id)->first();


        $http = new Client();
        $response = $http->post('https://c1b4390d.ngrok.io/api/user/deposit',
            ['form_params'=>[
                'userID' => $userID,
                'key' => $key,
                'amount' => $amount
            ]]);



        $getbody=json_decode($response->getBody()->getContents());
//        $getbody=$response->getBody()->getContents();
//        echo $getbody;

//        dd($response);


        return response()->json(['msg' => '存款成功','Basemsg' => $getbody,'data'=> $sheep_data]);

//            }else {

//                $msg = Base::get();


//                return response()->json(['msg' => 'done']);

//            }
    }
}
