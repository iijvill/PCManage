@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-text-center" uk-grid>
            <div class="uk-margin-left uk-margin-right">
                <p class="uk-text-right uk-margin-right">
                    @if (!empty($mode[0]) && $mode[0]->run != 1)
                        前回棚卸し期間:
                        @if (!empty($mode[0]->start_date))
                            {{$mode[0]->start_date}}　〜　{{$mode[0]->stop_date}}
                        @else
                            未実施
                        @endif   
                    @endif
                </p>
                
                <div class="uk-card uk-card-default uk-card-body uk-padding-remove-horizontal">
                    @if (!empty($checkdata) && count($checkdata) != 0)
                        <table class="uk-table uk-table-striped uk-table-small uk-table-hover uk-table-responsive table-bordered" id="pclists">
                            <thead>
                                <tr>
                                    <th class="uk-table-expand sort" data-sort="department">所属 ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="username">使用者 ↕︎</th>
                                    <th class="uk-width-small sort" data-sort="pcname">PC名 ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="pcmaker">メーカー ↕︎</th>
                                    <th class="uk-table-expand sort" data-sort="pctype">筐体 ↕︎</th>
                                    <th class="stockconfirm">棚卸しチェック</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($checkdata as $value)
                                <tr>
                                    <td class="department">{{$value->department_name}}</td>
                                    <td class="username">{{$value->employee_name}}</td>
                                    <td class="pcname">{{$value->pc_name}}</td>
                                    <td class="pcmaker">{{$value->pcmaker_name}}</td>
                                    <td class="pctype">{{$value->pctype_name}}</td>
                                    <td>
                                        @if ($value->is_checked == 0)
                                            <p style="color:#e83929">未確認</p>
                                        @else
                                            <p style="color:#028760">確認済み</p>
                                        @endif
                                    </td>
                                </tr>
                                    {{-- <tr>
                                        <td class="department">{{$department[$value->department - 1]->department_name}}</td>
                                        <td class="username">{{$employee[$value->pc_user_id - 1]->user_name}}</td>
                                        <td class="pcname">{{$value->pc_name}}</td>
                                        <td class="pcmaker">{{$pcmaker[$value->pc_maker - 1]->name}}</td>
                                        <td class="pctype">{{$pctype[$value->pc_type - 1]->name}}</td>
                                        <td class="stockconfirm">
                                            @if ($value->is_checked == 0)
                                                <p style="color:#e83929">未確認</p>
                                            @else
                                                <p style="color:#028760">確認済み</p>
                                            @endif
                                        </td>
                                    </tr> --}}
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

    <script>
        //並べ替えの処理
        var options = {
            valueNames: [ 'department', 'username', 'pcname', 'pcmaker', 'pctype'] //ソートするカラムのclass名っぽい
        };
        var userList = new List('pclists', options);
    </script>
@endsection