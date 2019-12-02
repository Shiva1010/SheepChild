<?php

namespace App\Http\Controllers;

use App\SheepItem;
use App\Item;
use App\Sheep;
use App\Wolf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Ecpay;
use ECPay_AllInOne;


class SheepItemController extends Controller
{


    public function EcpayReturnURL()
    {

        return response()->json(['msg' => '已收款，可出貨']);

    }

    public function EcpayClientBack()
    {

        return response()->json(['msg' => '結完帳後回到了首頁']);

    }


    public function EcpayDemo(request $request)
    {

        $Ecpay = new ECPay_AllInOne();



//        include('ECPay.Payment.Integration.php');

        $amount = $request['amount'];

        //基本參數(可依系統規劃自行調整)
        $Ecpay->Send['ReturnURL']         = "http://b37ed050.ngrok.io/api/EcpayReturnURL" ;
        //交易結果回報的網址
        $Ecpay->Send['ClientBackURL']     = "http://b37ed050.ngrok.io/api/ClientBackURL" ;
        //交易結束，讓user導回的網址
        $Ecpay->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
        $Ecpay->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
        $Ecpay->Send['TotalAmount']       = $amount;                     //交易金額
        $Ecpay->Send['TradeDesc']         = "good to drink" ;         //交易描述
        $Ecpay->Send['EncryptType']      = '1' ;
        $Ecpay->Send['ChoosePayment']     = "Credit" ;     //付款方式:信用卡
        $Ecpay->Send['PaymentType']        = 'aio' ;

//        訂單的商品資料
//        array_push($Ecpay->Send['Items'],
//            array('Name' => "美美小包包",
//                'Price' => (int)"2000",
//                'Currency' => "元",
//                'Quantity' => (int) "1",
//                'URL' => "http://www.yourwebsites.com.tw/Product"));

        //Go to EcPay
        echo "線上刷卡頁面導向中...";
//        echo Ecpay::i()->CheckOutForm();

        //開發階段，如果你希望看到表單的內容，可以改為以下敘述：
//        echo $Ecpay->CheckOutForm('按我，才送出');
        echo $Ecpay->QueryTradet();

    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sheep = Sheep::find($id);

        $sheepItem = $sheep->items()->paginate(10);

        $sheep['item'] = $sheepItem;

        return response()->json(['data' => $sheep]);
    }

    public function total()//算出sheeps的總花費＝wolf的銷售總金額
    {   
        $count = 0;
        $sheeps = Sheep::all();//collection [{Sheep},{Sheep},]

        // for($i=0; $i<$sheeps->length;$i++;){
        //     $sheeps[i]->stocks();
        // }
        foreach ($sheeps as $sheep) {

            $totals = $sheep->totals;

            foreach($totals as $total) {
                $count += $total->pivot->total;
            }
        }

        return response()->json(['data' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {   
        $item = Item::where('id', $request->item_id)->first();

        $sheep = Sheep::where('account', $request->account)->first();

        $wolf = Wolf::find(1);

        

        
        // dd(count($achieve2));

        if(!$item){

            return response()->json(['msg' => 'this item does not exit']);

        }else if($item->stock <= 0) {

            return response()->json(['msg' => 'stock is empty']);

        }

        $stockResult = $item->stock - $request->stock;

        if($stockResult < 0){

            return response()->json(['msg' => 'stock is not enough to sell']);

        }

        $stock = $request->stock;

        $itemStock = $item->stock;

        $total = $request->stock * $item->price;


//        $userID = $request['sheep_email'];
//        $key = $request['key'];
//        $shop_account = 'arcadia@camp.com';
//        $amount = 300;
//
//
////            if (env('pass_status')) {
//
//
//
//        $http = new Client();
//        $response = $http->post('https://b555418b.ngrok.io/api/user/transfer',
//            ['form_params'=>[
//                'userID' => $userID,
//                'key' => $key,
//                'account' => $shop_account,
//                'amount' => $amount,
//            ]]);
//
//         $response->getBody();
//         dd($response);


        DB::transaction(function () use ($request, $item, $total, $stockResult, $sheep, $wolf){

            $sheepBuy = Sheep::where('account', $request->account)->first()->items()->attach([

                $request->item_id => ['price' => $item->price, 'stock' => $request->stock, 'total' => $total],
            ]);

            $updateItemStock = $item->update(['stock' => $stockResult]);

            $addScore = $sheep->update(['score' => $sheep->score + $total, 'balance' => $sheep->balance - $total]);

            $updateWolfBalance = $wolf->update(['balance' => $wolf->balance + $total]);

        });  

        $achieve1 = DB::table('item_sheep')->where(function($query)use ($sheep){

            $query->Where('sheep_id', '=', $sheep->id);
            $query->Where('item_id', '=', '90');


        })->get();



        $achieve2 = DB::table('item_sheep')->where(function($query)use ($sheep){

            $query->Where('sheep_id', '=', $sheep->id);
            $query->Where('item_id', '=', '91');


        })->get();

        
        $secretItem = DB::table('item_sheep')->where(function($query)use ($sheep){

            $query->Where('sheep_id', '=', $sheep->id);
            $query->Where('item_id', '=', '87');


        })->get();

        $achieve1 = count($achieve1);
        $achieve2 = count($achieve2);
        $secretItem = count($secretItem);

        if($achieve1 && $achieve2 && !$secretItem) {

                    $sheepBuy = Sheep::where('account', $request->account)->first()->items()->attach([

                    17 => ['price' => 0, 'stock' => 1, 'total' => 0],
                    ]);

                    $sheep['item'] = $item->only(['id', 'sort_id', 'item_name']);//show respones

                    $sheep['achevement'] = "恭喜得到深水炸彈！";//show respones

                    return response()->json(['msg' => 'buy item success', 'data' => $sheep],201);

        } else

            $sheep['item'] = $item->only(['id', 'sort_id', 'item_name']);//show respones

            return response()->json(['msg' => 'buy item success', 'data' => $sheep],201);

        //  if(!count($achieve1)>0 && count($achieve2)>0){
        // }return response()->json(['msg' => 'your achievement']);
        
    }
}
