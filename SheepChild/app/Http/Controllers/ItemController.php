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
         $timeValidate = request()->validate([
            'item_name' => 'required',
            'sort_id' => 'required',
            'sort_name' => 'required',
            'price' => 'required',
        ]);

            $timeCreate = Item::create([
                'item_name' => $request['item_name'],
                'sort_id' => $request['sort_id'],
                'sort_name' => $request['sort_name'],
                'price' => $request['price'],
            ]);

        return response()->json(['msg' => 'add item success!', 'data' => 'ok'],201);
    }

    public function upload(Request $request)
    {   
        // 因為我們不需要太多的東西，只需要request array裡頭的東西
        $parameters = request()->all();

        if (request()->hasFile('pic'))
        {   
            // 檔案存在，所以存到project/storage/app/public，並拿到url，此範例會拿到public/fileName
            $imageURL = request()->file('pic')->store('public');
            // 因為我們只想要將純粹的檔名存到資料庫，所以特別做處理
            $parameters['pic'] = substr($imageURL, 7);

            $URL = asset('storage/' . $parameters['pic']);

            return response()->json(['photo URL' => $URL, 'file name' => $parameters['pic']], 201);
        }
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
