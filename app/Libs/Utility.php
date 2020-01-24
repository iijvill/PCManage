<?php

namespace App\Libs;

use App\Model\Stockconfirmcheck;
use App\Model\SystemMode;

class Utility
{

    //現在のチェック状況を調べる
    //全てチェックされていればtrue、１つでもチェックされていなければfalseを返す
    public static function checkStockconfirm(){

        $stock = StockConfirmcheck::get();

        $mode = SystemMode::where('systemmode_id', 1)->first();

        $flag = true;//全てチェックされていることを示す。

        if(!empty($mode)){
            if($mode->run != 0){
                if(!empty($stock) && count($stock) != 0){
                    foreach($stock as $st){
                        //１つでも未実施が見つかったらfalseとする
                        if($st->is_checked == 0){
                            $flag = false;
                            break;
                        }
                    }
                }
            }
        }


        // if(!empty($stock) && count($stock) != 0){
        //     foreach($stock as $st){
        //         //１つでも未実施が見つかったらfalseとする
        //         if($st->is_checked == 0){
        //             $flag = false;
        //             break;
        //         }
        //     }
        // }

        // dd($flag);
        return $flag;
    }

}