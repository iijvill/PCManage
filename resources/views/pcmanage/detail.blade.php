@extends('layouts.app')
@section('content')
    <section class="uk-card uk-card-body">
        <form class="uk-form-horizontal uk-margin-small" id="form_edit" action="/edit" method="POST">
            @csrf
            <div class="uk-section">
                @if ($errors->any())
                    <div class="alert alert-warning uk-margin-xlarge-left uk-margin-xlarge-right">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid">
                    <div><!--左のコンテンツ-->
                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">基本情報</div>
                            <div class="uk-margin">
                                <label class="uk-form-label">PC名</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="pc_name" value="{{$pcinfo_list->pc_name}}">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">所属部門</label>
                                <div class="uk-form-controls">
                                    @if (!empty($department_list) && count($department_list) != 0)
                                        <select class="uk-select" name="department">
                                            @foreach ($department_list as $d)
                                                @if ($d->department_id == $pcinfo_list->department)
                                                    <option value="{{$d->department_id}}" selected>{{$d->department_name}}</option>
                                                @else
                                                    <option value="{{$d->department_id}}">{{$d->department_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="部門情報を読み込めませんでした" readonly>
                                    @endif
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">筐体</label>
                                <div class="uk-form-controls">
                                    @if (!empty($pctype_list) && count($pctype_list) != 0)
                                        <select class="uk-select" name="pc_type">
                                            @foreach ($pctype_list as $ty)
                                                @if ($ty->pctype_id == $pcspec_list->pc_type)
                                                    <option value="{{$ty->pctype_id}}" selected>{{$ty->pctype_name}}</option>
                                                @else
                                                    <option value="{{$ty->pctype_id}}">{{$ty->pctype_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="筐体情報を読み込めませんでした" readonly>
                                    @endif
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">Officeライセンス</label>
                                <div class="uk-form-controls">
                                    @if (!empty($pcinfo_list->office_license))
                                        <input class="uk-input" type="text" name="office_license" value="{{$pcinfo_list->office_license}}">
                                    @else
                                        <input class="uk-input" type="text" name="office_license" placeholder="不明の場合は空欄で🙆‍♂️">
                                    @endif
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">PCメーカー</label>
                                <div class="uk-form-controls">
                                    @if (!empty($pcmaker_list) && count($pcmaker_list) != 0)
                                        <select class="uk-select" name="pc_maker">
                                            @foreach ($pcmaker_list as $mk)
                                                @if ($mk->pcmaker_id == $pcspec_list->pc_maker)
                                                    <option value="{{$mk->pcmaker_id}}" selected>{{$mk->pcmaker_name}}</option>
                                                @else
                                                    <option value="{{$mk->pcmaker_id}}">{{$mk->pcmaker_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="筐体情報を読み込めませんでした" readonly>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="uk-margin">
                                <label class="uk-form-label">シリアル番号</label>
                                <div class="uk-form-controls">
                                    @if (!empty($pcinfo_list->serial_number))
                                        <input class="uk-input" type="text" name="serial_number" value="{{$pcinfo_list->serial_number}}">
                                    @else
                                        <input class="uk-input" type="text" name="serial_number" placeholder="不明の場合は空欄でもOK👌">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">使用者を選択</div>
                            <div class="uk-margin">
                                <label class="uk-form-label">使用者</label>
                                <div class="uk-form-controls">
                                    @if (!empty($employee_list) && count($employee_list) != 0)
                                        <select class="uk-select" name="pc_user_id">
                                            @foreach ($employee_list as $e)
                                                @if ($e->employee_id == $pcinfo_list->pc_userid)
                                                    <option value="{{$e->employee_id}}" selected>{{$e->employee_name}}</option>
                                                @else
                                                    <option value="{{$e->employee_id}}">{{$e->employee_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="uk-input uk-form-danger" type="text" value="使用者情報を読み込めませんでした" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    <div> <!--右のコンテンツ-->
                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">スペック</div>
                            <div class="uk-margin">
                                <label class="uk-form-label">OS</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" name="os">
                                        @foreach ($os_list as $os)
                                            @if ($os->os_id == $pcspec_list->os)
                                                <option value="{{$os->os_id}}" selected>{{$os->os_name}}</option>
                                            @else
                                                <option value="{{$os->os_id}}">{{$os->os_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">CPU</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" name="cpu">
                                        @foreach ($cpu_list as $cpu)
                                            @if ($cpu->cpu_id == $pcspec_list->cpu)
                                                <option value="{{$cpu->cpu_id}}" selected>{{$cpu->cpu_name}}</option>
                                            @else
                                                <option value="{{$cpu->cpu_id}}">{{$cpu->cpu_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">メモリ</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="memory" value="{{$pcspec_list->memory}}">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">ストレージ</label>
                                <div class="uk-form-controls">
                                    <div class="uk-form-control">
                                        @if (!empty($storagetype_list) && count($storagetype_list) != 0)
                                            <select class="uk-select uk-form-width-small" name="storage_type">
                                                @foreach ($storagetype_list as $st)
                                                    @if ($st->storage_id == $pcspec_list->storage_type)
                                                        <option value="{{$st->storage_id}}" selected>{{$st->storage_name}}</option>
                                                    @else
                                                        <option value="{{$st->storage_id}}">{{$st->storage_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <input class="uk-input uk-form-width-small" type="text" name="storage_capacity" value="{{$pcspec_list->storage_capacity}}">
                                        @else
                                            <input class="uk-input uk-form-danger" type="text" value="ストレージ情報を読み込めませんでした" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">ウイルス対策</div>
                            <div class="uk-margin">
                                @if (!empty($antivirus_list) && count($antivirus_list) != 0)
                                    @if (empty($antivirus_relation_list->antivirus_id))
                                        @foreach ($antivirus_list as $a)
                                            <label><input class="uk-radio" type="radio" name="antivirus_id" value="{{$a->antivirus_id}}" required>{{$a->antivirus_name}} 【期限:{{$a->limit}}】</label><br>
                                        @endforeach
                                    @else
                                        @foreach ($antivirus_list as $a)
                                            @if ($antivirus_relation_list->antivirus_id == $a->antivirus_id)
                                                <label><input class="uk-radio" type="radio" name="antivirus_id" value="{{$a->antivirus_id}}" checked>{{$a->antivirus_name}} 【期限:{{$a->limit}}】</label><br>
                                            @else
                                                <label><input class="uk-radio" type="radio" name="antivirus_id" value="{{$a->antivirus_id}}">{{$a->antivirus_name}} 【期限:{{$a->limit}}】</label><br>
                                            @endif
                                        @endforeach
                                    @endif
                                @else
                                    <input class="uk-input uk-form-danger" type="text" value="ウイルス対策情報を読み込めませんでした" readonly>
                                @endif
                            </div>
                        </div>

                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">メモ</div>
                            <div class="uk-margin">
                                <textarea class="uk-textarea" name="memo" rows="10">{{$pcinfo_list->memo}}</textarea>
                            </div>
                        </div>
                        <input type="hidden" value="{{$pcinfo_list->barcode}}" name="barcode">
                        @if (!empty(Auth::guard('admin')->check()))
                            @if (!empty($mode) && count($mode) != 0)
                                @if ($mode[0]->run != 1)
                                    <button class="uk-button uk-button-primary uk-button-large uk-box-shadow-large" type="submit">情報を変更</button>

                                    <div class="uk-placeholder uk-margin">
                                        <label class="uk-form-label">PC情報を削除</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-checkbox" type="checkbox" name="del_flg">
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <input type="hidden" name="pcid" value="{{$pcinfo_list->id}}">
        </form>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            submitAlert({form_id:'form_edit', dialog_title:'PC情報を変更します', dialog_text:'よろしいですか？', dialog_finish_title:'PC情報を更新しました', redirect_flg: true, redirect_url:'/show'});
        });
    </script>
@endsection