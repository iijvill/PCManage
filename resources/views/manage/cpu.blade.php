@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    @if (!empty($cpu) && count($cpu) != 0)
                        <form id="editData" class="uk-form-horizontal uk-margin-small" action="/cpu/send" method="POST">
                            {{ csrf_field() }}
                            <table class="uk-table uk-table-divider">
                                <tr>
                                    <th>名称</th>
                                    <th>削除</th>
                                </tr>
                                @foreach ($cpu as $c)
                                    <tr>
                                        <input type="hidden" name="cpu_id[]" value="{{$c->cpu_id}}">
                                        <td>
                                            <input type="text" class="uk-input" name="cpu_name[]" value="{{$c->cpu_name}}">
                                        </td>
                                        <td><input type="checkbox" class="uk-checkbox" name="del[]" value="{{$c->cpu_id}}"></td>
                                    </tr>
                                @endforeach
                            </table>
                            <button class="uk-button uk-button-primary">更新</button>
                        </form>
                    @endif
                </div>
                <br><br>
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form class="uk-form-horizontal uk-margin-small" id="addData" action="/cpu/add" method="POST">
                        {{ csrf_field() }}
                        <div>
                            <input class="uk-input uk-width-3-5" type="text" name="cpu_name" placeholder="例)Core i9">
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