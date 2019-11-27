<?php

namespace App\Http\Controllers;

use App\Sheep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ItemSheep;

class WolfItemController extends Controller
{

    public function selltotal()
    {
        $sellstock = DB::table('item_sheep')->sum('stock');
        $selltoltal = DB::table('item_sheep')->sum('total');



        if ($selltoltal < 10000) {

            return response()->json([
                'msg' => '狼先生，您這樣店會倒的',
                'lv' => 0,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);

        }elseif ($selltoltal < 20000) {
            return response()->json([
                'msg' => '狼先生，請再多努力賺錢',
                'lv' => 1,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);
        }elseif ($selltoltal < 30000) {
            return response()->json([
                'msg' => '狼先生，你是不是不太適合當商人',
                'lv' => 2,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);
        }elseif ($selltoltal < 40000) {
            return response()->json([
                'msg' => '狼先生，我們稍微可以活久一點了',
                'lv' => 3,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);
        }elseif  ($selltoltal < 50000) {
            return response()->json([
                'msg' => '狼先生，越來越有錢了呢',
                'lv' => 4,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);
        }else {
            return response()->json([
                'msg' => '狼先生，您好棒喔！',
                'lv' => 5,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
            ]);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
