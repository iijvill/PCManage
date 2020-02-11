<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\EmployeeInfo;
use App\Model\Authority;
use App\Model\PcInfo;
use App\Model\SystemMode;

use Carbon\Carbon;
class EmployeeController extends Controller
{
    //社員一覧ページを表示
    public function showEmployee(){
        $employees      = EmployeeInfo::get();
        $authority      = Authority::get();
        $systemmode     = SystemMode::get();

        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        //viewに渡すデータをまとめる
        $disp_data = [
            'employees'      => $employees,
            'authority'      => $authority,
            'pc_counts'      => $pc_counts,
            'pcstock_counts' => $pcstock_counts,
            'mode'           => $systemmode,
        ];

        return view('pcmanage.employee', $disp_data);
    }

    
    //社員追加ページを表示
    public function showEmployeeAdd(){
        $authority      = Authority::get();
        $systemmode     = SystemMode::get();

        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        //viewに渡すデータをまとめる
        $disp_data = [
            'authority'      => $authority,
            'pc_counts'      => $pc_counts,
            'pcstock_counts' => $pcstock_counts,
            'mode'           => $systemmode,
        ];

        return view('pcmanage.employeeadd', $disp_data);
    }


    //社員編集ページを表示
    public function showEmployeeEdit($id){
        $employee       = EmployeeInfo::where('employee_id', $id)->first();
        $authority      = Authority::get();
        $systemmode     = SystemMode::get();

        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        //viewに渡すデータをまとめる
        $disp_data = [
            'employee'       => $employee,
            'authority'      => $authority,
            'pc_counts'      => $pc_counts,
            'pcstock_counts' => $pcstock_counts,
            'mode'           => $systemmode,
        ];

        return view('pcmanage.employeeedit', $disp_data);
    }



    //社員の追加処理
    public function employeeAdd(Request $request){

        //値のバリデート
        $this->validate($request,[
            'name'  => 'required|max:100',
            'email' => 'nullable|email|max:200',
        ]);
        
        //DBに追加
        EmployeeInfo::insert([
            'employee_name'  => $request->name,
            'email'          => $request->email,
            'authority'      => $request->authority,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ]);

        return null;
    }


    //社員の編集処理
    public function employeeEdit(Request $request){
        //削除ボックスにチェックが入っていれば削除
        if(!empty($request->del_flg) && $request->del_flg == true){
            EmployeeInfo::where('employee_id', $request->id)->delete();
        }

        //値のバリデート
        $this->validate($request,[
            'name'  => 'required|max:100',
            'email' => 'nullable|check_contain_space|email|max:200',
        ]);

        //該当データの更新
        EmployeeInfo::where('employee_id', $request->id)->update([
            'employee_name'  => $request->name,
            'email'          => $request->email,
            'authority'      => $request->authority,
            'updated_at'     => Carbon::now(),
        ]);

        return null;
    }

}
