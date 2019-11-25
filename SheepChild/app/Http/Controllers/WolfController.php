<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Sheep;
use App\Wolf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;

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
        // 確認是否有相同 account
        $check_account =Wolf::where('account', $request->account)->first();

        // 如果未註冊，則進入驗證資料是否符合格式跟創建會員資料
        if($check_account == null) {

            $rules = [
                'account' => ['required', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'max:20'],
                'name' => ['required', 'string', 'max:30'],
            ];

            $input = request()->all();

            // 驗證請求資料規則是否符合
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {

                return response()->json(['msg' => $validator->errors()]);

            } else {

                $api_token = Str::random(10);

                // 店家預設註冊給 1000000 元
                $balance = 1000000;
                $camp_name = 'Arcadia';

                // hash password
                $HashPwd = Hash::make($request['password']);

                $create = Wolf::create([
                    'camp_name' => $camp_name,
                    'name' => $request['name'],
                    'account' => $request['account'],
                    'password' => $HashPwd,
                    'balance' => $balance,
                    'api_token' => $api_token,
                ]);

                return response()->json([
                    'msg' => '店家註冊成功',
                    'create_date' => $create,
                ]);

            }
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
