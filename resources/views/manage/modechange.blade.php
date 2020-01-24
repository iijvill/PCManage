@extends('layouts.app')
@section('content')
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form id="modechange" class="uk-form-horizontal uk-margin-small" action="/modechange/send" method="POST">
                        {{ csrf_field() }}
                        <div class="uk-card-title">システムモード変更</div>
                        @if (!empty($mode) && count($mode) != 0)
                            {{-- <table class="uk-table">
                                <tr>
                                    <td>モード名</td>
                                    <td>状態</td>
                                </tr>
                                @foreach ($mode as $item)
                                    <tr>
                                        <input type="hidden" name="id" value="{{$item->systemmode_id}}">
                                        <td>{{$item->systemmode_name}}</td>
                                        <td>
                                            @if ($item->run == 0)
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="1">有効</label><br>
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="0" checked>無効</label>                                   
                                            @else
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="1" checked>有効</label><br>
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="0" >無効</label>                          
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="uk-button uk-button-primary" id="button">モードを変更</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table> --}}

                            <table class="uk-table uk-table-small uk-table-responsive uk-table-divider">
                                <tr>
                                    <td class="uk-table-expand">モード名</td>
                                    <td colspan="2">状態</td>
                                </tr>
                                @foreach ($mode as $item)
                                    <tr>
                                        <input type="hidden" name="id" value="{{$item->systemmode_id}}">
                                        <td>{{$item->systemmode_name}}</td>
                                        <td>
                                            @if ($item->run == 0)
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="1">有効</label><br>
                                            @else
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="1" checked>有効</label><br>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->run == 0)
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="0" checked>無効</label>
                                            @else
                                                <label class="uk-form-label"><input class="uk-radio" type="radio" name="run" value="0" >無効</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <button class="uk-button uk-button-primary" id="button">モードを変更</button>
                        @else
                            
                        @endif
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#button').prop('disabled', true);
            if('{{$is_allchecked}}'){
                submitAlert({form_id: 'modechange', dialog_title:'システムモードを変更します', dialog_text:'よろしいですか？', dialog_finish_title:'モードを変更しました', redirect_flg: true, redirect_url: '/modechange'});
            }else{
                submitAlert({form_id: 'modechange', dialog_title:'棚卸しが終わっていないようです', dialog_text:'それでもモードを変更しますか？', dialog_finish_title:'モードを変更しました', redirect_flg: true, redirect_url: '/modechange'});
            }
        });

        $('input[name=run]:radio').change(function(){
            $('#button').prop('disabled', false);
        });
    </script>
@endsection