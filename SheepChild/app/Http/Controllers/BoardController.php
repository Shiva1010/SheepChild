<?php

namespace App\Http\Controllers;

use App\Board;
use App\Sheep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DB;

class BoardController extends Controller
{

    public function newsheepmsg(request $request)
    {
        $sheep = Auth::user();
        $sheep_id = $sheep -> id;
        $sheepdata = $sheep ->where('id',$sheep_id)->first();

        $rules =[
            'sheep_msg' => ['required'],
        ];

        $input = $request->all();

        $validator =Validator::make($input, $rules);

        if($validator -> fails()){

            return response() -> json(['msg' => $validator ->errors()], 403);

        }else{

            $create =Board::create([
                'sheep_id' => $sheep_id,
                'sheep_msg' => $request['sheep_msg'],
            ]);

            return response() -> json(['msg' => '留言成功','sheep' => $sheepdata ,'newsheepmsg' => $create]);

        }

    }

    public function oldsheepmsg()
    {
        $sheep_id = Auth::user()->id;
        $sheep_data = Auth::user()->where('id',$sheep_id)->first();
        $sheepallmsg = Board::where('sheep_id',$sheep_id)->orderBy('id','desc')->get();

        return response() ->json(['msg' => '目前的留言狀況','sheep' => $sheep_data, 'sheepallmsg' => $sheepallmsg]);


    }

    public function wolfreplay(Request $request)
    {
        $wolf_id = Auth::user()->id;
        $board = Board::where('id',$request['id'])->first();
        $board_sheep_id = $board -> value('sheep_id');
        $sheepdate = Sheep::where('id',$board_sheep_id)->first();

        $update = $board->update([

            'wolf_id' => $wolf_id,
            'wolf_msg' => $request['wolf_msg'],

        ]);

        if ($update)
        {
            $replay_msg =Board::where('id',$request['id'])->first();
           return response()->json(['msg','回覆訊息成功','sheep'=>$sheepdate,'replay_msg'=> $replay_msg,]);
        }else{
            return response()->json(['msg' => '回覆留言失敗'],403);
        }

    }

    public function  allmsg()
    {



        $allmsg = DB::table('boards')
            ->join('sheep','boards.sheep_id','=','sheep.id')
            ->orderBy('boards.id','desc')
            ->get();


//        $users = DB::table('users')
//            ->join('contacts', 'users.id', '=', 'contacts.user_id')
//            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->select('users.*', 'contacts.phone', 'orders.price')
//            ->get();

//        $allmsg=Board::orderBy('id','desc')->get();

        return response()->json(['msg' => '目前所有小羊的留言', 'allmsg' => $allmsg]);
    }




}
