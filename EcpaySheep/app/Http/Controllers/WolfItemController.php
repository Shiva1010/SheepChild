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

        $lv01 = 10000;
        $lv02 = 20000;
        $lv03 = 30000;
        $lv04 = 40000;
        $lv05 = 50000;
        $max = -1;


        if ($selltoltal < $lv01) {

            $last_lv_score01 = $lv01 - $selltoltal;

            return response()->json([
                'msg' => '狼先生，您這樣店會倒的',
                'lv' => 0,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $last_lv_score01,
            ]);

        }elseif ($selltoltal < $lv02) {

            $last_lv_score02 = $lv02 - $selltoltal;

            return response()->json([
                'msg' => '狼先生，請再多努力賺錢',
                'lv' => 1,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $last_lv_score02,
            ]);

        }elseif ($selltoltal < $lv03) {

            $last_lv_score03 = $lv03 - $selltoltal;

            return response()->json([
                'msg' => '狼先生，你是不是不太適合當商人',
                'lv' => 2,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $last_lv_score03,
            ]);

        }elseif ($selltoltal < $lv04) {

            $last_lv_score04 = $lv04 - $selltoltal;

            return response()->json([
                'msg' => '狼先生，我們稍微可以活久一點了',
                'lv' => 3,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $last_lv_score04,
            ]);
        }elseif  ($selltoltal < $lv05) {

            $last_lv_score05 = $lv05 - $selltoltal;

            return response()->json([
                'msg' => '狼先生，越來越有錢了呢',
                'lv' => 4,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $last_lv_score05,
            ]);

        }else {
            return response()->json([
                'msg' => '狼先生，您好棒喔！',
                'lv' => 5,
                'all_stock'=>$sellstock,
                'all_total'=>$selltoltal,
                'last_lv' => $max,
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
