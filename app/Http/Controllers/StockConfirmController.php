<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\PcInfo;
use App\Model\DepartmentInfo;
use App\Model\EmployeeInfo;
use App\Model\PctypeInfo;
use App\Model\PcmakerInfo;
use App\Model\Stockconfirmcheck;
use App\Model\SystemMode;
use App\Model\AntivirusInfo;
use App\Model\AntivirusRelation;
use App\Model\PcSpec;
use App\Model\CpuInfo;
use App\Model\OsInfo;
use App\Model\StorageType;

use Carbon\Carbon;

//在庫チェック周りの処理をするコントローラー
class StockConfirmController extends Controller
{

    //システムモードを変更する時の処理
    //モード変更時の開始日時と終了日時を保存しておくとあとあとわかりやすそう？？
    public function modeChange(Request $request){
        $mode_id = $request->id;
        $mode_run = $request->run;
        
        /**
         * mode_run = 0 -> 通常
         * mode_run = 1 -> 棚卸しモード中
         */
        /**
         * 0->1に変更された＝棚卸しモードになった→start_dateに現在の日付を入れる
         * 1->0に変更された＝通常モードになった＝棚卸しが終わった→stop_dateに現在の日付を入れる
         * 0->1に変更された時、すでにstop_dateに値がある場合はnullを明示的に入れる(start_date > stop_dateはありえないため)
         */


        if($mode_run == 0){
            //通常モードになった
            $stop = Carbon::now();

            SystemMode::where('systemmode_id', $mode_id)->update([
                'run' => $mode_run,
                'stop_date' => $stop,
            ]);
        }else{
            //棚卸しモードになった
            $start = Carbon::now();
            $stop = null;

            SystemMode::where('systemmode_id', $mode_id)->update([
                'run' => $mode_run,
                'start_date' => $start,
                'stop_date'  => $stop,
            ]);

            //stockconfirmcheckのis_checkedを全てfalseに変更する
            $stockconfirm = Stockconfirmcheck::get();
            
            foreach($stockconfirm as $st){
                $st->update([
                    'is_checked' => 0,
                ]);
            }
        }
    
        return null;
    }

    //棚卸し時の在庫チェックページ
    public function showStockCheckPage(){
        $pcinfo            = PcInfo::get();
        $department        = DepartmentInfo::get();
        $employee          = EmployeeInfo::get();
        $pctype            = PctypeInfo::get();
        $pcmaker           = PcmakerInfo::get();
        $systemmode        = SystemMode::get();
        $stockconfirmcheck = stockConfirmCheck::get();
    

        $checkdata = PcSpec::join('pc_infos', 'pc_specs.spec_id', '=', 'pc_infos.id')
                        ->leftJoin('stockconfirmchecks', 'pc_infos.id', '=', 'stockconfirmchecks.stockconfirm_id')
                        ->leftJoin('department_infos', 'pc_infos.department', '=', 'department_infos.department_id')
                        ->leftJoin('employee_infos', 'pc_infos.pc_userid', '=', 'employee_infos.employee_id')
                        ->leftJoin('pcmaker_infos', 'pc_specs.pc_maker', '=', 'pcmaker_infos.pcmaker_id')
                        ->leftJoin('pctype_infos', 'pc_specs.pc_type', '=', 'pctype_infos.pctype_id')
                        ->get();

        $disp_data = [
            'checkdata'     => $checkdata,
            'department'    => $department,
            'employee'      => $employee,
            'pctype'        => $pctype,
            'pcmaker'       => $pcmaker,
            'mode'          => $systemmode,
            'stockcheck'    => $stockconfirmcheck,
            'now'           => Carbon::now()->format('Y-m-d'),
        ];

        return view('manage.stockcheck', $disp_data);
    }


    //QRコードを読み込んでアクセスする想定。
    public function stockConfirm($id){
        $systemmode  = SystemMode::get();
        $specs       = PcSpec::where('id', $id)->join('pc_infos', 'pc_specs.spec_id', '=', 'pc_infos.id')
                    ->leftJoin('department_infos', 'pc_infos.department', '=', 'department_infos.department_id')
                    ->leftJoin('employee_infos', 'pc_infos.pc_userid', '=', 'employee_infos.employee_id')
                    ->leftJoin('pcmaker_infos', 'pc_specs.pc_maker', '=', 'pcmaker_infos.pcmaker_id')
                    ->leftJoin('pctype_infos', 'pc_specs.pc_type', '=', 'pctype_infos.pctype_id')
                    ->leftJoin('cpu_infos', 'pc_specs.cpu', '=', 'cpu_infos.cpu_id')
                    ->leftJoin('os_infos', 'pc_specs.os', '=', 'os_infos.os_id')
                    ->leftJoin('storage_types', 'pc_specs.storage_type', '=', 'storage_types.storage_id')
                    ->first();

        $antivirus_relation = AntivirusRelation::where('antivirus_relations.antirelation_id', $id)->leftJoin('antivirus_infos', 'antivirus_relations.antivirus_id', '=', 'antivirus_infos.antivirus_id')->first();

        $disp_data = [
            'antivirus_relation' => $antivirus_relation,
            'mode'               => $systemmode,
            'specs'              => $specs,
        ];
        
        return view('pcmanage.m_pcinfo', $disp_data);
    }

    //スマホから登録ボタンを押された後の処理
    public function stockCheck(Request $request){
        //時間差でモードがオフになっている可能性を考える
        $mode = SystemMode::where('systemmode_id', 1)->first();
        if(!empty($mode) && $mode->run != 0){
            if($request->check){
                $now = Carbon::now();
                $now = $now->format('Y-m-d');

                $stockckeck = Stockconfirmcheck::where('stockconfirm_id', $request->id)->update([
                    'is_checked'    => 1,
                    'access_date' => $now,
                ]);
            }
        }
        return redirect('/stockconfirm/thanks');
    }
}
