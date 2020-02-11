<?php
namespace App\Validator;
use Illuminate\Validation\Validator;

use App\Model\PcInfo;
use App\Model\Admin;
class CustomValidator extends Validator{

    //独自のバリデーションを指定

    //メソッドは「validate」から始まる必要がある
    //以下のメソッドだと、バリデーションを使用するときは「sample」、「password_check」になる。
    public function validateSample($attribute, $value, $parameters){
        return false;
    }

    public function validatePasswordCheck($attribute, $value, $parameters){
        return false;
    }

    

    public function validateCheckContainSpace($attribute, $value, $parameters){
        //半角スペースか全角スペースしか記入されていないかチェック
        
        if(preg_match("/([ |　]+)/u",$value)){
            return false;
        }
        return true;
    }



    public function validateCheckNumber($attribute, $value, $parameters){
        //00や001など0の連続で始まる数値を除外
        //.*で改行以外の文字列の０回以上の連続
        //
        if(!preg_match("/^(?![0]+).*$/u",$value, $res)){
            return false;
        }
        return true;
    }


    
    public function validateCheckZero($attribute, $value, $parameters){
        if($value == 0){
            return false;
        }
        return true;
    }


    public function validateCheckApproved($attribute, $email, $rule){
        $db_data = Admin::where('email',$email)->first();
        //type=0 未認証の場合はエラー
        if($db_data->type == 0){
            return false;
        }
        return true;
    }


}