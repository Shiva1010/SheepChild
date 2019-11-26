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

        return response()->json(['msg'=>'狼先生，這是目前銷售的情形','all_stock'=>$sellstock,'all_total'=>$selltoltal]);

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
