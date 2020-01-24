@extends('layouts.app')
@section('content')
        <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form class="uk-form-horizontal uk-margin-small" id="form_edit" action="/employee/edit" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (!empty($employee))
                            <div class="uk-card-title">使用者情報</div>
                            <div class="uk-margin">
                                <label class="uk-form-label">氏名</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="name" value="{{$employee->employee_name}}">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">メールアドレス</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="email" value="{{$employee->email}}">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">権限</label>
                                <div class="uk-form-controls">
                                    @if (!empty($authority) && count($authority) != 0)
                                        <select class="uk-select" name="authority">
                                            @foreach ($authority as $item)
                                                @if ($item->auth_id == $employee->authority)
                                                    <option value="{{$item->auth_id}}" selected>{{$item->auth_name}}</option>
                                                @else
                                                    <option value="{{$item->auth_id}}">{{$item->auth_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="権限情報を読み込めませんでした" readonly>
                                    @endif
                                </div>
                            </div>
                            <button class="uk-button uk-button-primary uk-button-large uk-box-shadow-large">登  録</button>

                            <div class="uk-placeholder uk-margin">
                                <label class="uk-form-label">使用者情報を削除</label>
                                <div class="uk-form-controls">
                                    <input class="uk-checkbox" type="checkbox" name="del_flg">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{$employee->employee_id}}">
                        @else
                            
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // submitAlert({form_id:'form_edit', dialog_title:'情報を変更します', dialog_text:'よろしいですか？', dialog_finish_title:'情報を変更しました', redirect_flg: true, redirect_url:'/employee'});
        });
    </script>
@endsection