<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LuckController extends Controller
{
    public function luck()
    {

        $luck_num=
        $proArr = array([
            array('id' => 1, 'name' => '可愛喜羊羊', 'v' => 1),
            array('id' => 2, 'name' => '豪宅', 'v' => 5),
            array('id' => 3, 'name' => '沒中獎', 'v' => 10),
        ]);

        $result = array();
        foreach ($proArr as $key => $val) {
            $arr[$key] = $val['v'];
        }
        // 概率数组的总权重
        $proSum = array_sum($arr);

        // 概率数组循环
        foreach ($arr as $k => $v) {

            // 从 1 到概率总数中任意取值
            $randNum = mt_rand(1, $proSum);
            $aa[$k] = $randNum . '+' . $v . '+' . $proSum;
            if ($randNum <= $v) {
                $result = $proArr[$k];
                // 找到符合条件的值就跳出 foreach 循环
                // dump($result);
                break;
            } else {
                $proSum = $proSum - $v;
                $bb[$k] = $randNum . '+' . $v . '+' . $proSum;
            }

        }
    }
}
