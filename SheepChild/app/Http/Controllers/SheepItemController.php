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

        $stock = $request->stock;

        $itemStock = Item::where('id',$request->item_id)->first()->stock;

        $downItemStock = $itemStock - $stock;

        $updateItemStock = $item->update(['stock' => $downItemStock]);

        $total = $request->stock * $item->price;

        $sheepBuy = Sheep::where('account', $request->account)->first()->items()->attach([

            $request->item_id => ['price' => $item->price, 'stock' => $stock, 'total' => $total ],
        ]);

        $addScore = $sheep->update(['score' => $sheep->score + $total]);

        $updateBalance = $sheep->update(['balance' => $sheep->balance - $total]);

        $sheep['item'] = $item->only(['id', 'sort_id', 'item_name']);//show respones
        
        // $sort = Item::where('sort_id', $item->sort_id)->with('sort')->first();

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
