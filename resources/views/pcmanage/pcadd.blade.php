@extends('layouts.app')
@section('content')
    <section class="uk-card uk-card-body">
        <form class="uk-form-horizontal uk-margin-small" id="form_edit" action="/add" method="POST">
            {{ csrf_field() }}
            <div class="uk-section">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid">
                    <div> <!--左のコンテンツ-->
                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">基本情報</div>
                            <div class="uk-margin">
                                <label class="uk-form-label">PC名</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="pc_name">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">所属部門</label>
                                <div class="uk-form-controls">
                                    @if (!empty($department_list) && count($department_list) != 0)
                                        <select class="uk-select" name="department">
                                            @foreach ($department_list as $dp)
                                                <option value="{{$dp->department_id}}">{{$dp->department_name}}</option>
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
                                                <option value="{{$ty->pctype_id}}">{{$ty->pctype_name}}</option>
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
                                    <input class="uk-input" type="text" name="office_license" placeholder="不明の場合は空欄で🙆‍♂️">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">PCメーカー</label>
                                <div class="uk-form-controls">
                                    @if (!empty($pcmaker_list) && count($pcmaker_list) != 0)
                                        <select class="uk-select" name="pc_maker">
                                            @foreach ($pcmaker_list as $mk)
                                                <option value="{{$mk->pcmaker_id}}">{{$mk->pcmaker_name}}</option>
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
                                    <input class="uk-input" type="text" name="serial_number" placeholder="不明の場合は空欄でもOK👌">
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
                                            @foreach ($employee_list as $em)
                                                <option value="{{$em->employee_id}}">{{$em->employee_name}}</option>
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
                                            <option value="{{$os->os_id}}">{{$os->os_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">CPU</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" name="cpu">
                                        @foreach ($cpu_list as $cpu)
                                            <option value="{{$cpu->cpu_id}}">{{$cpu->cpu_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">メモリ</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" name="memory">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">ストレージ</label>
                                <div class="uk-form-controls">
                                    <div class="uk-form-control">
                                        @if (!empty($storagetype_list) && count($storagetype_list) != 0)
                                            <select class="uk-select uk-form-width-small" name="storage_type">
                                                @foreach ($storagetype_list as $st)
                                                    <option value="{{$st->storage_id}}">{{$st->storage_name}}</option>
                                                @endforeach
                                            </select>
                                            <input class="uk-input uk-form-width-small" type="text" name="storage_capacity">
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
                                    @foreach ($antivirus_list as $a)
                                        @if ($a->antivirus_id == 1)
                                            <label><input class="uk-radio" type="radio" name="antivirus_id" value="{{$a->antivirus_id}}" checked>{{$a->antivirus_name}}</label><br> 
                                        @else
                                            <label><input class="uk-radio" type="radio" name="antivirus_id" value="{{$a->antivirus_id}}">{{$a->antivirus_name}} 【期限:{{$a->limit}}】</label><br> 
                                        @endif
                                    @endforeach
                                @else
                                    <input class="uk-input uk-form-danger" type="text" value="ウイルス対策情報を読み込めませんでした" readonly>
                                @endif
                            </div>
                        </div>

                        <div class="uk-card uk-card-default uk-margin uk-card-body uk-box-shadow-large">
                            <div class="uk-card-title">メモ</div>
                            <div class="uk-margin">
                                <textarea class="uk-textarea" name="memo" rows="10"></textarea>
                            </div>
                        </div>
                        <button class="uk-button uk-button-primary uk-button-large uk-box-shadow-large " type="submit">登　録</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            submitAlert({form_id:'form_edit', dialog_title:'PC情報を登録します', dialog_text:'よろしいですか？', dialog_finish_title:'PC情報を登録しました', redirect_flg: true, redirect_url:'/show'});
        });
    </script>
@endsection