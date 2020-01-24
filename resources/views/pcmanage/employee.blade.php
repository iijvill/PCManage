@extends('layouts.app')
@section('content')
    <div class="uk-section">
        {{-- PC管理者以上のみ社員を追加できるように表示を変更する --}}
        @if (!empty($mode) && count($mode) != 0)
            @if ($mode[0]->run != 1)
                <div class="uk-child-width-expand uk-text-center" uk-grid>
                    <div class="uk-flex uk-flex-center">
                        <a class="uk-button uk-button-primary" href="{{config('const.path_employee_add')}}">使用者情報を追加する</a>
                    </div>
                </div>
            @endif
        @endif
        <div class="uk-child-width-expand uk-text-center uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-padding-remove-horizontal">
                    @if (!empty($employees) && count($employees) != 0)
                        <table class="uk-table uk-table-striped uk-table-small uk-table-hover uk-table-responsive">
                            <thead>
                                <tr>
                                    <td class="uk-table-expand">名前</td>
                                    <td class="uk-table-expand">メールアドレス</td>
                                    {{-- <td class="uk-table-small">権限</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $e)
                                    <tr>
                                        @if (!empty($mode) && count($mode) != 0)
                                            @if ($mode[0]->run != 1)
                                                <td><a href="{{config('const.path_employee_edit')}}/{{$e->employee_id}}">{{$e->employee_name}}</a></td>
                                            @else
                                                <td>{{$e->employee_name}}</td>
                                            @endif
                                        @endif
                                        {{-- <td><a href="{{config('const.path_employee_edit')}}/{{$e->employee_id}}">{{$e->user_name}}</a></td> --}}
                                        <td>{{$e->email}}</td>
                                        {{-- <td>{{$authority[$e->authority - 1]->auth_name}}</td> --}}
                                    </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger">
                            <label class="ul-label">使用者情報がありません。</label>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection