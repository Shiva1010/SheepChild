<?php

namespace App\Http\Controllers;

//use App\Base;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BaseController extends Controller
{
        public function userbuy(request $request)
        {

            $userID = $request['sheep_email'];
            $key = $request['key'];
            $shop_account = 'arcadia@email.com';
            $amount = 300;


//            if (env('pass_status')) {

                $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                $out->writeln('index 有進來test路徑');

                $http = new Client();
                $response = $http->post('https://b555418b.ngrok.io/api/user/transfer',
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

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln('index 有進來test路徑');

        $http = new Client();
        $response = $http->post('https://b555418b.ngrok.io/api/user/watch',
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
}
