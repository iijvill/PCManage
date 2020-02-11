@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    @if (!empty($os) && count($os) != 0)
                        <form id="editData" class="uk-form-horizontal uk-margin-small" action="/os/send" method="POST">
                            {{ csrf_field() }}
                            <table class="uk-table uk-table-divider">
                                <tr>
                                    <th>名称</th>
                                    <th>削除</th>
                                </tr>
                                @foreach ($os as $o)
                                    <tr>
                                        <input type="hidden" name="os_id[]" value="{{$o->os_id}}">
                                        <td>
                                            <input type="text" class="uk-input" name="os_name[]" value="{{$o->os_name}}">
                                        </td>
                                        <td><input type="checkbox" class="uk-checkbox" name="del[]" value="{{$o->os_id}}"></td>
                                    </tr>
                                @endforeach
                            </table>
                            <button class="uk-button uk-button-primary">更新</button>
                        </form>
                    @endif
                </div>
                <br><br>
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form class="uk-form-horizontal uk-margin-small" id="addData" action="/os/add" method="POST">
                        {{ csrf_field() }}
                        <div>
                            <input class="uk-input uk-width-3-5" type="text" name="os_name" placeholder="例)Windows Vista">
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