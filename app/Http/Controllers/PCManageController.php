<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\PcInfo;
use App\Model\PcSpec;
use App\Model\DepartmentInfo;
use App\Model\AntivirusInfo;
use App\Model\AntivirusRelation;
use App\Model\EmployeeInfo;
use App\Model\StorageType;
use App\Model\PctypeInfo;
use App\Model\PcmakerInfo;
use App\Model\Stockconfirmcheck;
use App\Model\SystemMode;
use App\Model\CpuInfo;
use App\Model\OsInfo;

use Carbon\Carbon;

use Auth;
use DB;
use Utility;

class PCManageController extends Controller
{
    //PC一覧を表示する
    public function showPCList(){
        $systemmode  = SystemMode::get();
        $specs       = PcSpec::join('pc_infos', 'pc_specs.spec_id', '=', 'pc_infos.id')
                        ->leftJoin('department_infos', 'pc_infos.department', '=', 'department_infos.department_id')
                        ->leftJoin('employee_infos', 'pc_infos.pc_userid', '=', 'employee_infos.employee_id')
                        ->leftJoin('pcmaker_infos', 'pc_specs.pc_maker', '=', 'pcmaker_infos.pcmaker_id')
                        ->leftJoin('pctype_infos', 'pc_specs.pc_type', '=', 'pctype_infos.pctype_id')
                        ->leftJoin('cpu_infos', 'pc_specs.cpu', '=', 'cpu_infos.cpu_id')
                        ->leftJoin('storage_types', 'pc_specs.storage_type', '=', 'storage_types.storage_id')
                        ->leftJoin('antivirus_relations', 'pc_infos.id', '=', 'antivirus_relations.antirelation_id')
                        ->leftJoin('antivirus_infos', 'antivirus_relations.antivirus_id', '=', 'antivirus_infos.antivirus_id')
                        ->get();

        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        $disp_data = [
            'specs_list'        => $specs,
            'pc_counts'         => $pc_counts,
            'pcstock_counts'    => $pcstock_counts,
            'mode'              => $systemmode,
        ];
        
        return view('pcmanage.pclist', $disp_data);
    }

    //PC詳細ページを表示
    public function showPCDetail($id){
        $pcinfo      = PcInfo::where('id', $id)->first();
        $department  = DepartmentInfo::get();
        $employee    = EmployeeInfo::get();
        $pctype      = PctypeInfo::get();
        $pcmaker     = PcmakerInfo::get();
        $pcspec      = PcSpec::where('spec_id', $id)->first();
        $storagetype = StorageType::get();
        $antivirus   = AntivirusInfo::get();
        $systemmode  = SystemMode::get();
        $os          = OsInfo::get();
        $cpu         = CpuInfo::get();

        $antivirus_relation = AntivirusRelation::where('antivirus_relations.antirelation_id', $id)->leftJoin('antivirus_infos', 'antivirus_relations.antivirus_id', '=', 'antivirus_infos.antivirus_id')->first();
        
        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        $disp_data = [
            'pcinfo_list'               => $pcinfo,
            'department_list'           => $department,
            'employee_list'             => $employee,
            'pctype_list'               => $pctype,
            'pcmaker_list'              => $pcmaker,
            'pcspec_list'               => $pcspec,
            'storagetype_list'          => $storagetype,
            'antivirus_list'            => $antivirus,
            'antivirus_relation_list'   => $antivirus_relation,
            'os_list'                   => $os,
            'cpu_list'                  => $cpu,
            'pc_counts'                 => $pc_counts,
            'pcstock_counts'            => $pcstock_counts,
            'mode'                      => $systemmode,
        ];

        return view('pcmanage.detail', $disp_data);
    }


    //PC情報のアプデ
    public function edit(Request $request){
        //削除にチェックマークが入っていれば削除
        if(!empty($request->del_flg) && $request->del_flg == true){

            //トランザクションを貼る
            DB::transaction(function() use($request){
                AntivirusRelation::where('antirelation_id', $request->pcid)->delete();
                PInfo::where('id', $request->pcid)->delete();
                PcSpec::where('spec_id', $request->pcid)->delete();
                Stcockconfirmcheck::where('stockconfirm_id', $request->pcid)->delete();
            });
            return null;
        }

        //バリデート。自作のバリデートクラスのCustomValidatorも使用
        $this->validate($request, [
            'pc_name'            => 'bail|required|max:50',
            'serial_number'      => 'nullable|regex:/^[a-zA-Z0-9-]+$/|max:50',
            'office_license'     => 'nullable|regex:/^[a-zA-Z0-9-@_.]+$/|max:50',
            'memory'             => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
            'storage_capacity'   => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
            'memo'               => 'nullable',
        ]);

        //トランザクションを貼る！
        DB::transaction(function() use($request){
            $pcinfo    = new PcInfo();
            $pcspec    = new PcSpec();
            $antivirus = new AntivirusRelation();

            $pcinfo->where('id', $request->pcid)->update([
                'pc_name'        => $request->pc_name,
                'pc_userid'      => $request->pc_user_id,
                'department'     => $request->department,
                'serial_number'  => $request->serial_number,
                'office_license' => $request->office_license,
                'memo'           => $request->memo,
                'updated_at'     => Carbon::now(),
            ]);

            $pcspec->where('spec_id', $request->pcid)->update([
                'os'               => $request->os,
                'cpu'              => $request->cpu,
                'memory'           => $request->memory,
                'storage_type'     => $request->storage_type,
                'storage_capacity' => $request->storage_capacity,
                'pc_type'          => $request->pc_type,
                'pc_maker'         => $request->pc_maker,
            ]);

            $antivirus->where('antirelation_id', $request->pcid)->update([
                'antivirus_id' => $request->antivirus_id,
            ]);
        });
        
        return null;
    }


    //PC追加画面を表示する
    public function showAddPage(){
        $department  = DepartmentInfo::get();   
        $pctype      = PctypeInfo::get();       
        $storagetype = StorageType::get();      
        $employee    = EmployeeInfo::get();     
        $antivirus   = AntivirusInfo::get();   
        $pcmaker     = PcmakerInfo::get();      
        $os          = OsInfo::get();          
        $cpu         = CpuInfo::get();          
        $systemmode  = SystemMode::get();

        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        $disp_data = [
            'department_list'    => $department,
            'pctype_list'        => $pctype,
            'storagetype_list'   => $storagetype,
            'employee_list'      => $employee,
            'antivirus_list'     => $antivirus,
            'pcmaker_list'       => $pcmaker,
            'pctype_list'        => $pctype,
            'os_list'            => $os,
            'cpu_list'           => $cpu,
            'pc_counts'          => $pc_counts,
            'pcstock_counts'     => $pcstock_counts,
            'mode'               => $systemmode,
        ];
        return view('pcmanage.pcadd',$disp_data);
    }


    //PCを追加する
    public function add(Request $request){
        //バリデート。自作のバリデートクラスのCustomValidatorも使用
        $this->validate($request,[
            'pc_name'            => 'bail|required|unique:pc_infos,pc_name|max:50',
            'serial_number'      => 'nullable|regex:/^[a-zA-Z0-9-]+$/|max:50',
            'office_license'     => 'nullable|regex:/^[a-zA-Z0-9-@_.]+$/|max:50',
            'memory'             => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
            'storage_capacity'   => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
            'memo'               => 'nullable',
        ]);

        //同時にデータを格納したいのでトランザクションを貼る
        DB::transaction(function()use($request){
            $pcinfo = new PcInfo();
            $pcspec = new PcSpec();
            $anti_relation = new AntivirusRelation();
            $stockconfirmcheck = new Stockconfirmcheck();
            $QRCodeURL = 'https://' .  config('const.default_domain') . '/stockconfirm/'; //QRコードに付与するURLの生成

            $id = $pcinfo->insertGetId([ //$idにこれから追加するDBのid番号を挿入
                'pc_name'        => $request->pc_name,
                'pc_userid'      => $request->pc_user_id,
                'department'     => $request->department,
                'serial_number'  => $request->serial_number,
                'pc_url'         => '',
                'office_license' => $request->office_license,
                'memo'           => $request->memo,
            ]);

            //データ追加直後に、QRコードに付与するURLを追加する
            $pcinfo->where('id', $id)->update([
                'pc_url'     => $QRCodeURL . $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $anti_relation->insert([
                'antivirus_id' => $request->antivirus_id,
            ]);

            $pcspec->insert([
                'os'                => $request->os,
                'cpu'               => $request->cpu,
                'memory'            => $request->memory,
                'storage_type'      => $request->storage_type,
                'storage_capacity'  => $request->storage_capacity,
                'pc_type'           => $request->pc_type,
                'pc_maker'          => $request->pc_maker,
            ]);

            $stockconfirmcheck::insert([
                'is_checked'  => 0,
                'access_date' => null,
            ]);
        });
        return null;
    }


    //検索ページを表示
    public function showSearchPage(){
        $department_list  = DepartmentInfo::get();
        $pcmaker_list     = PcmakerInfo::get();
        $pctype_list      = PctypeInfo::get();
        $storagetype_list = StorageType::get();
        $os_list          = OsInfo::get();
        $cpu_list         = CpuInfo::get();

        $disp_data = [
            'department_list'  => $department_list,
            'pcmaker_list'     => $pcmaker_list,
            'pctype_list'      => $pctype_list,
            'storagetype_list' => $storagetype_list,
            'os_list'          => $os_list,
            'cpu_list'         => $cpu_list,
        ];

        return view('pcmanage.search', $disp_data);
    }


    //検索処理
    public function search(Request $request){
        $department  = DepartmentInfo::get();
        $employee    = EmployeeInfo::get();
        $pctype      = PctypeInfo::get();
        $pcmaker     = PcmakerInfo::get();
        $antivirus   = AntivirusInfo::get();
        $relation    = AntivirusRelation::get();
        $os          = OsInfo::get();
        $cpu         = CpuInfo::get();
        $systemmode  = SystemMode::get();
        $storage     = StorageType::get();

        $this->validate($request,[
            'pc_memory'          => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
            'storage_capacity'   => 'bail|nullable|numeric|check_contain_space|digits_between:1,4|check_zero|check_number',
        ]);


        $pc_counts      = PcInfo::count();   //PCの総数を取得
        $pcstock_counts = PcInfo::where('department', 1)->count(); //在庫数を計算

        $query = PcSpec::query();
        $specs = $this->_searchData($query, $request);

        $antivirus = AntivirusRelation::leftJoin('antivirus_infos', 'antivirus_relations.antivirus_id', '=', 'antivirus_infos.antivirus_id')->get();

        $disp_data = [
            'specs_list'        => $specs,
            'antivirus_list'    => $antivirus,
            'pc_counts'         => $pc_counts,
            'pcstock_counts'    => $pcstock_counts,
            'mode'              => $systemmode,
        ];

        return view('pcmanage.pclist', $disp_data);
    }


    //システム全体のモード変更ページ
    public function showModeChangePage(){
        $systemmode = SystemMode::get();

        //アクセスの時の棚卸しチェック状況を調べる
        $isAllChecked = Utility::checkStockconfirm();

        $disp_data = [
            'mode' => $systemmode,
            'is_allchecked' => $isAllChecked,
        ];
        return view('manage.modechange', $disp_data);
    }
    


    //動的クエリの作成処理
    function _searchData($query, $request){

        $query->join('pc_infos', 'pc_specs.spec_id', '=', 'pc_infos.id')
                        ->leftJoin('department_infos', 'pc_infos.department', '=', 'department_infos.department_id')
                        ->leftJoin('employee_infos', 'pc_infos.pc_userid', '=', 'employee_infos.employee_id')
                        ->leftJoin('pcmaker_infos', 'pc_specs.pc_maker', '=', 'pcmaker_infos.pcmaker_id')
                        ->leftJoin('pctype_infos', 'pc_specs.pc_type', '=', 'pctype_infos.pctype_id')
                        ->leftJoin('cpu_infos', 'pc_specs.cpu', '=', 'cpu_infos.cpu_id')
                        ->leftJoin('storage_types', 'pc_specs.storage_type', '=', 'storage_types.storage_id')
                        ->leftJoin('antivirus_relations', 'pc_infos.id', '=', 'antivirus_relations.antirelation_id')
                        ->leftJoin('antivirus_infos', 'antivirus_relations.antivirus_id', '=', 'antivirus_infos.antivirus_id');

        $req_depart = $request->department;

        if(!empty($req_depart)){
            $query->whereIn('department', explode(',', $req_depart));
        }

        $req_maker = $request->pc_maker;
        if($req_maker != 1){//全て以外なら
            $query->where('pc_maker', '=', $req_maker);
        }

        $req_type = $request->pc_type;
        if($req_type != 1){ //全て以外なら
            $query->where('pc_type', '=', $req_type);
        }

        $req_os = $request->pc_os;
        if($req_os != 1){
            $query->where('os', '=', $req_os);
        }

        $req_cpu = $request->pc_cpu;
        if($req_cpu != 1){
            $query->where('cpu', '=', $req_cpu);
        }

        $req_mem = $request->pc_memory;
        if($req_mem != '' || $req_mem != null){
            $query->where('memory', '=', $req_mem);
        }

        $req_s_type = $request->storage_type;
        if($req_s_type != 1){
            $query->where('storage_type', '=', $req_s_type);
        }

        $req_scapa = $request->storage_capacity;
        if($req_scapa != '' || $req_scapa != null){
            $query->where('storage_capacity', '=', $req_scapa);
        }

        $db_data = $query->get();

        return $db_data;
    }
}
