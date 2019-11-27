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



class SheepItemController extends Controller
{
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


        $userID = $request['sheep_email'];
        $key = $request['key'];
        $shop_account = 'arcadia@camp.com';
        $amount = 300;


//            if (env('pass_status')) {



        $http = new Client();
        $response = $http->post('https://b555418b.ngrok.io/api/user/transfer',
            ['form_params'=>[
                'userID' => $userID,
                'key' => $key,
                'account' => $shop_account,
                'amount' => $amount,
            ]]);

         $response->getBody();
         dd($response);


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
