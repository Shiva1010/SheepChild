<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Sheep;
use App\Wolf;

class ItemController extends Controller
{
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
        $time = request()->validate([
            'item_name' => 'required',
            'sort_id' => 'required',
            'sort_name' => 'required',
            'price' => 'required',
        ]);

        $time = request()->validate([
            'item_name' => $request['item_name'],
            'sort_id' => $request['sort_id'],
            'sort_name' => $request['sort_name'],
            'price' => $request['price'],
        ]);


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
