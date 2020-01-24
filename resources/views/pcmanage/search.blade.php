<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="preload" href="{{asset('css/app.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/app.css') }}"></noscript>
</head>
<body>
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-left uk-margin-right">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="uk-form-horizontal uk-margin-small" method="POST">
                        <table class="uk-table table-bordered">
                            <tr>
                                <td class="uk-width-medium">所属</td>
                                <td colspan="2">
                                    @php
                                        $i = 1
                                    @endphp
                                    @if (!empty($department_list) && count($department_list) != 0)
                                        @foreach ($department_list as $d)
                                            <label class="uk-form-label"><input class="uk-checkbox" type="checkbox" name="department" value="{{$d->department_id}}"> {{$d->department_name}}</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            @if ($i % 2 == 0)
                                                <br>
                                            @endif
                                            @php
                                                $i++
                                            @endphp
                                        @endforeach
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="情報を読み込めませんでした" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>メーカー</td>
                                <td colspan="2">
                                    @if (!empty($pcmaker_list) && count($pcmaker_list) != 0)
                                        <select class="uk-select" name="pc_maker">
                                            @foreach ($pcmaker_list as $mk)
                                                @if ($mk->pcmaker_id == 1)
                                                    <option value="{{$mk->pcmaker_id}}">全て</option>
                                                @else
                                                    <option value="{{$mk->pcmaker_id}}">{{$mk->pcmaker_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="情報を読み込めませんでした" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>筐体</td>
                                <td colspan="2">
                                    @if (!empty($pctype_list) && count($pctype_list) != 0)
                                        <select class="uk-select" name="pc_type">
                                            @foreach ($pctype_list as $l)
                                                @if ($l->pctype_id == 1)
                                                    <option value="{{$l->pctype_id}}">全て</option>
                                                @else
                                                    <option value="{{$l->pctype_id}}">{{$l->pctype_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>          
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="情報を読み込めませんでした" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>OS</td>
                                <td colspan="2">
                                    <select class="uk-select" name="os">
                                        @foreach ($os_list as $o)
                                            @if ($o->os_id == 1)
                                                <option value="{{$o->os_id}}">全て</option>
                                            @else
                                                <option value="{{$o->os_id}}">{{$o->os_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td colspan="2">
                                    <select class="uk-select" name="pc_cpu">
                                        @foreach ($cpu_list as $c)
                                            @if ($c->cpu_id == 1)
                                                <option value="{{$c->cpu_id}}">全て</option>
                                            @else
                                                <option value="{{$c->cpu_id}}">{{$c->cpu_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>メモリ</td>
                                <td colspan="2">
                                    <input class="uk-input" type="text" name="pc_memory">
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">ストレージ</td>
                                <td>タイプ</td>
                                <td>
                                    @if (!empty($storagetype_list) && count($storagetype_list) != 0)
                                        <select class="uk-select" name="storage_type">
                                            @foreach ($storagetype_list as $t)
                                                @if ($t->storage_id == 1)
                                                    <option value="{{$t->storage_id}}">全て</option>
                                                @else
                                                    <option value="{{$t->storage_id}}">{{$t->storage_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>     
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="情報を読み込めませんでした" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>容量</td>
                                <td>
                                    <input class="uk-input uk-width-small" type="text" name="storage_capacity"> <b>GB</b>
                                </td>
                            </tr>
                        </table>
                        <div class="uk-flex uk-flex-center">
                            <button class="uk-button uk-button-primary" id="search_setting" type="button">検索</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#search_setting').on('click', function(){
                var fm = window.opener.document.formSearch; //親画面のform(name=formSearch)オブジェクトを取得
        
                //所属
                fm.department.value = $('[name="department"]:checked').map(function(){
                    return $(this).val();
                }).get();

                //メーカー
                fm.pc_maker.value   = $('[name="pc_maker"]').val();

                //筐体
                fm.pc_type.value    = $('[name="pc_type"]').val();

                //CPU
                fm.pc_cpu.value     = $('[name="pc_cpu"]').val();

                fm.pc_os.value      = $('[name="os"]').val();

                //メモリ
                fm.pc_memory.value  = $('[name="pc_memory"]').val();

                //ストレージタイプ
                fm.storage_type.value = $('[name="storage_type"]').val();

                //ストレージ容量
                fm.storage_capacity.value = $('[name="storage_capacity"]').val();

                //親ウインドウで検索を行う
                fm.submit();

                return false;
            });
        });
    </script>
</body>
</html>