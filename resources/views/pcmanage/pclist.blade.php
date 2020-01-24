@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-text-center" uk-grid>
            <div class="uk-flex uk-flex-center">
                @if (!empty(Auth::guard('admin')->check()))
                    @if (!empty($mode) && count($mode) != 0)
                        @if ($mode[0]->run != 1)
                            <div class="uk-margin-right">
                                <a class="uk-button uk-button-primary" href="{{config('const.path_add')}}">PC情報を追加する</a>
                            </div>
                        @endif
                    @endif
                @endif
                <div class="uk-margin-left">
                    <button class="uk-button uk-button-primary" type="submit" id="search">検索</button>
                </div>
            </div>
        </div>
        <div class="uk-child-width-expand uk-text-center" uk-grid>
            <div class="uk-margin-left uk-margin-right">
                <div class="uk-card uk-card-default uk-card-body uk-padding-remove-horizontal">
                    @if (!empty($specs_list) && count($specs_list) != 0)
                        <table class="uk-table uk-table-striped uk-table-small uk-table-hover uk-table-responsive table-bordered" id="pclists">
                            <thead>
                                <tr>
                                    <th class="uk-table-expand sort" data-sort="department">所属 ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="username">使用者 ↕︎</th>
                                    <th class="uk-width-small sort" data-sort="pcname">PC名 ↕︎</th>
                                    <th >Officeライセンス ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="pcmaker">メーカー ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="pctype">筐体 ↕︎</th>
                                    <th class="uk-width-small sort" data-sort="cpu">CPU ↕︎</th>
                                    <th class="uk-width-small sort" data-sort="memory">メモリ ↕︎</th>
                                    <th class="uk-width-small sort" data-sort="sttype">容量 ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="antiname">ウイルス対策ソフト</th>
                                    <th class="uk-table-expand sort" data-sort="antilimit">期限日</th>
                                    <th class="uk-width-small">残り日数</th>
                                    <th class="uk-table-expand">メモ</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($specs_list as $pc)
                                    <tr>
                                        <td class="department">
                                            @if (empty($pc->department_name))
                                                <p style="color:#e83929">所属情報未設定</p>
                                            @else
                                                {{$pc->department_name}}
                                            @endif
                                        </td>
                                        <td class="username">
                                            @if (empty($pc->employee_name))
                                                <p style="color:#e83929">使用者未設定</p>
                                            @else
                                                {{$pc->employee_name}}
                                            @endif
                                        </td>
                                        <td class="pcname"><a href="{{config('const.path_detail')}}/{{$pc->id}}">{{$pc->pc_name}}</a></td>
                                        <td class="office">{{$pc->office_license}}</td>
                                        <td class="pcmaker">
                                            @if (empty($pc->pcmaker_name))
                                                <p style="color:#e83929">PCメーカー未設定</p>
                                            @else
                                                {{$pc->pcmaker_name}}
                                            @endif
                                        </td>
                                        <td class="pctype">
                                            @if (empty($pc->pcmaker_name))
                                                <p style="color:#e83929">筐体未設定</p>
                                            @else
                                                {{$pc->pctype_name}}
                                            @endif
                                        </td>
                                        <td class="cpu">
                                            @if (empty($pc->cpu_name))
                                                <p style="color:#e83929">CPU未設定</p>
                                            @else
                                                {{$pc->cpu_name}}
                                            @endif
                                        </td>
                                        <td class="memory">                                        
                                            @if ($pc->memory != null)
                                                {{$pc->memory}} GB
                                            @else
                                                不明
                                            @endif
                                        </td>
                                        <td class="sttype">
                                            @if (empty($pc->storage_type))
                                                <p style="color:#e83929">ストレージ情報未設定</p>
                                            @else
                                                @if ($pc->storage_type != 1)
                                                    {{$pc->storage_name}} {{$pc->storage_capacity}} GB
                                                @else
                                                    {{$pc->storage_name}}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{$pc->antivirus_name}}
                                        </td>
                                        <td class="limit">
                                            {{$pc->limit}}
                                        </td>
                                        <td></td>
                                        <td>{!! nl2br(e($pc->memo))!!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning uk-margin-xlarge-left uk-margin-xlarge-right">
                            PCの情報がありませんでした。
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <form name="formSearch" action="/search" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="department" value="">
        <input type="hidden" name="pc_maker" value="">
        <input type="hidden" name="pc_type" value="">
        <input type="hidden" name="pc_os" value="">
        <input type="hidden" name="pc_cpu" value="">
        <input type="hidden" name="pc_memory" value="">
        <input type="hidden" name="storage_type" value="">
        <input type="hidden" name="storage_capacity" value="">
    </form>


    <script>
        var search_win;
        //ページ読み込み時に実行する
        $(document).ready(function(){
            //検索ボタン押下時
            $('#search').on('click', function(){
                search_win = window.open('/search', null, 'width=960 , height=895');
                return false;
            });

            var now = new Date();
            var limit_dates = document.getElementsByClassName('limit');
            for(var i = 0, len = limit_dates.length|0; i < len; i = i + 1 | 0){//なにこのfor文
                date = limit_dates[i].textContent.trim();
                diff = Math.ceil((Date.parse(date) - now.getTime())/86400000)
                if(!isNaN(diff)){
                    $("td:nth-last-of-type(2)")[i].innerText = diff;
                    if(diff < 0){
                        //期限切れ
                        $("td:nth-last-of-type(2)")[i].style = "background-color:#d7003a; color:#302833";
                    }else if(diff < 30){
                        //期限まで30日
                        $("td:nth-last-of-type(2)")[i].style = "background-color:#ea5506; color:#302833";
                    }else if(diff < 200){
                        //期限まで200日
                        $("td:nth-last-of-type(2)")[i].style = "background-color:#ffd900; color:#302833";
                    }else{
                        //期限まで200日以上
                        $("td:nth-last-of-type(2)")[i].style = "background-color:#007b43; color:#302833";
                    }
                }
            }    
        });

    </script>
    <script>
        //並べ替えの処理
        var options = {
            valueNames: [ 'department', 'username', 'pcname', 'pcmaker', 'pctype', 'cpu', 'memory', 'sttype', 'antiname', 'antilimit'] //ソートするカラムのclass名っぽい
        };
        var userList = new List('pclists', options);
    </script>
@endsection