@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    @if (!empty($department) && count($department) != 0)
                        <form id="editData" class="uk-form-horizontal uk-margin-small" action="/department/send" method="POST">
                            {{ csrf_field() }}
                            <table class="uk-table uk-table-divider">
                                <tr>
                                    <th>所属</th>
                                    <th>削除</th>
                                </tr>
                                @foreach ($department as $d)
                                    <tr>
                                        <input type="hidden" name="department_id[]" value="{{$d->department_id}}">
                                        <td>
                                            <input type="text" class="uk-input" name="department_name[]" value="{{$d->department_name}}">
                                        </td>
                                        <td><input type="checkbox" class="uk-checkbox" name="del[]" value="{{$d->department_id}}"></td>
                                    </tr>
                                @endforeach
                            </table>
                            <button class="uk-button uk-button-primary">更新</button>
                        </form>
                    @endif
                </div>
                <br><br>
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form class="uk-form-horizontal uk-margin-small" id="addData" action="/department/add" method="POST">
                        {{ csrf_field() }}
                        <div>
                            <input class="uk-input uk-width-3-5" type="text" name="department_name" placeholder="例)メディア">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="uk-button uk-button-primary">追加</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        confirmAlert({form_id:'editData', dialog_title: '情報を編集しました'});
        confirmAlert({form_id:'addData', dialog_title: '情報を追加しました'});
    });
    </script>
@endsection