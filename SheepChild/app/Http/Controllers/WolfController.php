<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;
use App\Item;
use App\Sheep;
use App\Wolf;



class WolfController extends Controller
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
        $timeValidate = request()->validate([
            'item_name' => 'required',
            'sort_id' => 'required',
            'sort_name' => 'required',
            'price' => 'required',
        ]);
        
        

        if (request()->hasFile('image')){

            $parameters = request()->all();
            
            $imageURL = request()->file('image')->store('public');

            $timeCreate = Item::create([
                'item_name' => $request['item_name'],
                'sort_id' => $request['sort_id'],
                'sort_name' => $request['sort_name'],
                'price' => $request['price'],
                'pic' => $request['image'] = substr($imageURL, 7)
            ]);

        }

        return response()->json(['msg' => 'add item success!', 'data' => 'ok'],201);
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

    public function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $item = Item::find($id)->first();

        $itemUpdate = $item->update($request->only(['item_name', 'sort_id', 'sort_name', 'price', 'stock'])
        );

        return response()->json(['msg' => 'eite item success!', 'data' => $itemUpdate],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id)->delete();

        return response()->json(['msg' => 'delete success!'],200);
    }
}
