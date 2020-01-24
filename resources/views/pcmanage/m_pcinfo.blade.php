<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>
</head>
<body>
    
    <div class="uk-section">
        <div class="uk-child-width-expand uk-text-center" uk-grid>
            <div class="uk-margin-left uk-margin-right">
                <div class="uk-card uk-card-default uk-card-body uk-padding-remove-horizontal">
                    <h3>PC情報</h3>
                    @if (!empty($specs))
                        <table class="uk-table-small uk-table-striped uk-table-responsive table-bordered">
                        <tr>
                            <td class="uk-width-small">PC名</td>
                            <td>
                                {{$specs->pc_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>所属部門</td>
                            <td>
                                {{$specs->department_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>筐体</td>
                            <td>
                                {{$specs->pctype_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>Office</td>
                            <td>
                                {{$specs->offilce_license}}
                            </td>
                        </tr>
                        <tr>
                            <td>メーカー</td>
                            <td>
                                {{$specs->pcmaker_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>シリアル番号</td>
                            <td>
                                {{$specs->serial_number}}
                            </td>
                        </tr>
                        <tr>
                            <td>使用者</td>
                            <td>
                                {{$specs->employee_name}}   
                            </td>
                        </tr>
                        <tr>
                            <td>OS</td>
                            <td>
                                {{$specs->os_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>CPU</td>
                            <td>
                                {{$specs->cpu_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>メモリ</td>
                            <td>
                                {{$specs->memory}}
                            </td>
                        </tr>
                        <tr>
                            <td>容量</td>
                            <td>
                                @if ($specs->storage_type != 1)
                                    {{$specs->storage_name}} &nbsp; {{$specs->storage_capacity}}
                                @else
                                    {{$specs->storage_name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>ウイルス対策</td>
                            <td>
                                {{$antivirus_relation->antivirus_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>メモ</td>
                            <td>
                                {{$specs->memo}}
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="uk-card uk-card-body">
        @if (!empty($mode) && count($mode) != 0)
        
            @if ($mode[0]->run == 1)
                <div class="uk-flex uk-flex-center">
                    <form name="checkform" action="/stockconfirm/send" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$pcinfo->id}}">
                        <label class="uk-form-label"><input class="uk-checkbox" type="checkbox" name="check" id="check">このPCは存在しています</label>
                        <br>
                        <br>
                        <div class="uk-flex uk-flex-center">
                            <button id="button" disabled="true" class="uk-button-primary uk-button" type="submit">登録する</button>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </section>
    <script>
        //チェックボックスのオンオフを検知して、チェックが入っていれば
        //ボタンを押せるようにする
        //チェックが入っていなければボタンを押せないようにする
        $('input').change(function(){
            if($(this).is(':checked')){
                $('#button').prop('disabled', false);
            }else{
                $('#button').prop('disabled', true);
            }
        });
    </script>
</body>
</html>