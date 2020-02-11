<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\DepartmentInfo;
use App\Model\PcmakerInfo;
use App\Model\OsInfo;
use App\Model\CpuInfo;
use App\Model\AntivirusInfo;
use App\Model\PctypeInfo;
use App\Model\SystemMode;

class InformationController extends Controller
{
    //部署表示
    public function showDepartment(){
        $department = DepartmentInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'department' => $department,
            'mode'       => $systemmode,
        ];
        return view('manage.department', $disp_data);
    }

    //部署編集
    public function editDepartment(Request $request){
        $list_id = $request->department_id;
        $list_del = $request->del;
        
        //要素分だけループさせる
        foreach($list_id as $list => $id){
            //バリデートを行う
            $this->validate($request, [
                'department_name.*' => 'bail|required|max:100',
            ]);
                
            // 削除にチェックが入っているか確認
            if(is_array($list_del) && in_array($id, $list_del, true)){
                //削除処理
                DepartmentInfo::where('department_id', $id)->delete();
            }else{
                //更新処理
                DepartmentInfo::where('department_id', $id)->update([
                    'department_name' => $request->department_name[$list]
                ]);
            }
        }
    }

    //部署追加
    public function addDepartment(Request $request){
        $this->validate($request, [
            'department_name' => 'bail|required|max:100',
        ]);
        $dp = new DepartmentInfo();
        $dp->fill($request->all())->save();
    }

//-------------------------------------------------------------------------------

    //PCメーカー
    public function showPCMaker(){
        $pcmaker = PcmakerInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'pcmaker' => $pcmaker,
            'mode'    => $systemmode,
        ];

        return view('manage.pcmaker', $disp_data);
    }

    //PCメーカーの編集
    public function editPCMaker(Request $request){
        $list_id = $request->pcmaker_id;
        $list_del = $request->del;

        foreach($list_id as $list => $id){
            $this->validate($request, [
                'pcmaker_name.*' => 'bail|required|max:50',
            ]); 

            if(is_array($list_del) && in_array($id, $list_del, true)){
                PcmakerInfo::where('pcmaker_id', $id)->delete();
            }else{
                PcmakerInfo::where('pcmaker_id', $id)->update([
                    'pcmaker_name' => $request->pcmaker_name[$list]
                ]);
            }
        }

    }

    //PCメーカーの追加
    public function addPCMaker(Request $request){
        $this->validate($request,[
            'pcmaker_name' => 'bail|required|max:50'
        ]);
        $mk = new PcmakerInfo();
        $mk->fill($request->all())->save();
    }

//-------------------------------------------------------------------------------

    //OS
    public function showOS(){
        $os = OsInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'os'   => $os,
            'mode' => $systemmode,
        ];
        return view('manage.os', $disp_data);
    }

    //OSの編集
    public function editOS(Request $request){
        $list_id = $request->os_id;
        $list_del = $request->del;

        foreach($list_id as $list => $id){
            $this->validate($request, [
                'os_name.*' => 'bail|required|max:30'
            ]);

            if(is_array($list_del) && in_array($id, $list_del, true)){
                OsInfo::where('os_id', $id)->delete();
            }else{
                OsInfo::where('os_id', $id)->update([
                    'os_name' => $request->os_name[$list]
                ]);
            }
        }

    }

    //OSの追加
    public function addOS(Request $request){
        $this->validate($request, [
            'os_name' => 'bail|required|max:30'
        ]);
        $os = new OsInfo;
        $os->fill($request->all())->save();
    }

//-------------------------------------------------------------------------------

    //CPU
    public function showCPU(){
        $cpu = CpuInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'cpu'  => $cpu,
            'mode' => $systemmode,
        ];
        return view('manage.cpu', $disp_data);
    }

    //CPUの編集
    public function editCPU(Request $request){
        $list_id = $request->cpu_id;
        $list_del = $request->del;
        foreach($list_id as $list => $id){
            $this->validate($request, [
                'cpu_name.*' => 'bail|required|max:30'
            ]);
            
            if(is_array($list_del) && in_array($id, $list_del, true)){
                CpuInfo::where('cpu_id', $id)->delete();
            }else{
                CpuInfo::where('cpu_id', $id)->update([
                    'cpu_name' => $request->cpu_name[$list]
                ]);
            }
        }
    }

    //CPUの追加
    public function addCPU(Request $request){
        $this->validate($request, [
            'cpu_name' => 'bail|required|max:30'
        ]);
        $cpu = new CpuInfo;
        $cpu->fill($request->all())->save();
    }

//-------------------------------------------------------------------------------

    //ウイルス対策
    public function showAntivirus(){
        $antivirus = AntivirusInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'antivirus' => $antivirus,
            'mode'      => $systemmode,
        ];
        return view('manage.antivirus', $disp_data);
    }

    //ウイルス対策の編集
    public function editAntivirus(Request $request){
        $list_id = $request->antivirus_id;
        $list_del = $request->del;
        // dd($request);
        foreach($list_id as $list => $id){
            $this->validate($request, [
                'antivirus_name.*' => 'bail|required|max:30'
            ]);
            
            if(is_array($list_del) && in_array($id, $list_del, true)){
                AntivirusInfo::where('antivirus_id', $id)->delete();
            }else{
                AntivirusInfo::where('antivirus_id', $id)->update([
                    'antivirus_name' => $request->antivirus_name[$list],
                    'limit'          => $request->limit[$list],
                ]);
            }
        }
    }

    //ウイルス対策の追加
    public function addAntivirus(Request $request){
        $this->validate($request, [
            'antivirus_name' => 'bail|required|max:30'
        ]);
        $a = new AntivirusInfo;
        $a->fill($request->all())->save();
    }

//-------------------------------------------------------------------------------

    //PC筐体
    public function showPCtype(){
        $antivirus = PctypeInfo::get();
        $systemmode = SystemMode::get();
        $disp_data = [
            'pctype' => $antivirus,
            'mode'   => $systemmode,
        ];
        return view('manage.pctype', $disp_data);
    }

    //PC筐体の編集
    public function editPCtype(Request $request){
        $list_id = $request->pctype_id;
        $list_del = $request->del;
        // dd($request);
        foreach($list_id as $list => $id){
            $this->validate($request, [
                'pctype_name.*' => 'bail|required|max:30'
            ]);
            
            if(is_array($list_del) && in_array($id, $list_del, true)){
                PctypeInfo::where('pctype_id', $id)->delete();
            }else{
                PctypeInfo::where('pctype_id', $id)->update([
                    'pctype_name' => $request->pctype_name[$list],
                ]);
            }
        }
    }

    //PC筐体の追加
    public function addPCtype(Request $request){
        $this->validate($request, [
            'pctype_name' => 'bail|required|max:30'
        ]);
        $ty = new PctypeInfo;
        $ty->fill($request->all())->save();
    }

}
