<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\PcInfo;
use \Milon\Barcode\DNS2D; //ファサード登録だけじゃダメで、この記述も必要
use Carbon\Carbon;

class QRController extends Controller
{
    //QRコードを作成・表示させる

    public function showVerifyPage(){
        //QRコードを作成する前のページ。
        //このページでは作成後へのリンク・QRコード化するURLのアップデート・QRコード化するURL一覧を表示させる

        $pcinfo = PcInfo::select('pc_name', 'pc_url')->get();

        $disp_data = [
            'pcinfo' => $pcinfo,
        ];
        
        return view('qr.verify', $disp_data);
    }



    public function showQRCode(){
        //実際にQRコードを出力するページ。QRコードだらけ。
        $pcinfo = PcInfo::select('pc_name', 'pc_url')->get();

        $qrarr = [];
        foreach($pcinfo as $p){
            $code = DNS2D::getBarcodeSVG($p->pc_url, 'QRCODE');
            array_push($qrarr, [$p->pc_name,$code]);
        }

        $disp_data = [
            'pcinfo' => $pcinfo,
            'arr'    => $qrarr,
        ];

        return view('qr.qr', $disp_data);
    }


    public function updateURL(){
        $pcinfo = PcInfo::get();

        $QRCodeURL = 'https://' .  config('const.default_domain') . '/stockconfirm/';
        
        if(!empty($pcinfo) && count($pcinfo) != 0){
            foreach($pcinfo as $info){
                $id = $info->id;
                PcInfo::where('id' , $id)->update([
                    'pc_url' => $QRCodeURL . $id,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
