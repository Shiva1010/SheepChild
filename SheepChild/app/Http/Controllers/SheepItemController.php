<?php

namespace App\Http\Controllers;

use App\SheepItem;
use App\Item;
use App\Sheep;
use App\Wolf;
use Illuminate\Http\Request;


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

        $sheepItem = $sheep->items()->get();

        $sheep['item'] = $sheepItem;

        return response()->json(['data' => $sheep]);
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

        $sheepBuy = Sheep::where('account', $request->account)->first()->items()->attach($request->item_id);

        $stock = $request->stock;

        // $sheep = Sheep::find(1);
        // $sheep->items;
        // $sheepItem = $sheep->items()->first();
       
        $sheep['item'] = $item;

        $sheep['stock'] = $stock;

        return response()->json(['msg' => 'buy item success', 'data' => $sheep]);
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
