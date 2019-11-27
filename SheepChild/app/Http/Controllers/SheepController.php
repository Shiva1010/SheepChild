<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Sheep;
use App\Wolf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\DB;


class SheepController extends Controller
{
    public function login(Request $request)
    {

        $rules = [
            'account' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'max:12'],
        ];

        $input = $request->all();

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {

            return response()->json(['msg' => $validator->errors()],403);

        } else {

            // 查詢帳戶是否在註冊名單內
            $check_account = Sheep::where('account', $request->account)->first();


            if ($check_account == null) {

                return response()->json(['msg' => '帳戶尚未註冊'],403);

            } else {

                // 從註冊名單內提取被 hash 的 password
                $hash_password = $check_account->password;

                $pwd = $request['password'];

                // 將 $request 的 password 與 DB 內已被 hash 的 password 做 check
                if (Hash::check($pwd, $hash_password)) {


                    $balance = $check_account['balance'];

                    $bonus =2000;

                    $after_balance = $balance + $bonus;

                    $api_token = Str::random(10);

                    $check_account->update(['api_token' => $api_token,'balance' => $after_balance]);

                    $now_sheep = Sheep::where('account', $request->account)->first();

                    $score = $now_sheep ->score;

                    $lv01 = 2000;
                    $lv02 = 5000;
                    $lv03 = 10000;
                    $lv04 = 20000;
                    $lv05 = 30000;


                    if ($score < $lv01) {


                        $last_lv_score01 = $lv01 - $score;

                        return response()->json([
                            'msg' => '可愛的小綿羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 0,
                            'now_flower' => $now_sheep,
                            'last_lv_score01' => $last_lv_score01,
                            ]);

                    }elseif ($score < $lv02) {

                        $last_lv_score02 = $lv02 - $score;

                        return response()->json([
                            'msg' => '可愛的小肥羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 1,
                            'now_flower' => $now_sheep,
                            'last_lv_score02' => $last_lv_score02,
                            ]);

                    }elseif ($score < $lv03) {

                        $last_lv_score03 = $lv03 - $score;

                        return response()->json([
                            'msg' => '可愛的大肥羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 2,
                            'now_flower' => $now_sheep,
                            'last_lv_score03' => $last_lv_score03,
                            ]);

                    }elseif ($score < $lv04) {

                        $last_lv_score04 = $lv04 - $score;

                        return response()->json([
                            'msg' => '可愛的超級大肥羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 3,
                            'now_flower' => $now_sheep,
                            'last_lv_score04' => $last_lv_score04,
                            ]);

                    }elseif  ($score < $lv05) {

                        $last_lv_score05 = $lv05 - $score;

                        return response()->json([
                            'msg' => '可愛的無敵超級大肥羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 4,
                            'now_flower' => $now_sheep,
                            'last_lv_score05' => $last_lv_score05,
                            ]);

                    }else {
                        return response()->json([
                            'msg' => '可愛的宇宙無敵超級大肥羊，歡迎光臨，今天想要買點什麼呢？',
                            'lv' => 5,
                            'now_flower' => $now_sheep,
                            'last_lv_score05' => '目前已經是最高等級了',
                            ]);

                    }

                } else {

                    return response()->json(['msg' => '密碼錯誤'],403);

                }

            }


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
        // 確認是否有相同 account
        $check_account =Sheep::where('account', $request->account)->first();

        // 如果未註冊，則進入驗證資料是否符合格式跟創建會員資料
        if($check_account == null) {

            $rules = [
                'name' => ['required', 'string','max:30'],
                'account' => ['required', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'max:20'],
            ];

            $input = request()->all();

            // 驗證請求資料規則是否符合
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {

                return response()->json(['msg' => $validator->errors()]);

            } else {

                $api_token = Str::random(10);

                // 店家預設註冊給 1000000 元
                $balance = 5000;
                $score = 0;



                // hash password
                $HashPwd = Hash::make($request['password']);

                $create = Sheep::create([
                    'name' => $request['name'],
                    'account' => $request['account'],
                    'password' => $HashPwd,
                    'balance' => $balance,
                    'api_token' => $api_token,
                    'score' => $score,
                ]);

                return response()->json([
                    'msg' => '可愛的肥羊，註冊成功',
                    'create_date' => $create,
                ]);
            }

        } else {
            return response()->json(['msg' => '此帳戶已被註冊'],403);
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

    public function allbuy($sheep_id)
    {
        $sheep =Sheep::where('id',$sheep_id)->first();

        $allbuy = DB::table('item_sheep')->where('sheep_id',$sheep_id)->join('items','item_sheep.item_id','=','items.id')->get();



        return response()->json(['msg'=>'買家所有購買的物品','sheep'=>$sheep,'SheepAllBuy'=>$allbuy]);
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
