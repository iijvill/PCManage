@extends('layouts.qrbase')
@section('content')
    <div>
        <br>
        <br>

        <ul class="uk-list">
            <li><button id="output" class="uk-button uk-button-primary">QRコードを出力する</button></li>
            <li><button id="refresh" class="uk-button uk-button-default">URLを最新のものにする</button></li>
        </ul>
        <table class="uk-table uk-table-small table-bordered">
            @if (!empty($pcinfo) && count($pcinfo) != 0)
                <tr>
                    <th>PC名</th>
                    <th>URL</th>
                </tr>
                @foreach ($pcinfo as $p)
                    <tr>
                        <td>{{$p->pc_name}}</td>
                        <td>{{$p->pc_url}}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $('#refresh').on('click', function(){
                Swal.fire({
                    title: 'URLを更新します',
                    text: 'よろしいですか？',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if(result.value){
                        event.preventDefault();
                        $.ajax({
                            url: '/qr/update',
                            type: 'GET',
                        })
                        .done(function(){
                            Swal.fire({
                                title: 'URLを更新しました'
                            });
                        })
                        .fail(function(){
                            Swal.fire({
                                title: '失敗'
                            });
                        });
                    }
                });
                
            });
        });
    </script>
    <script>
        var search_win;
        $(document).ready(function(){
            //検索ボタン押下時
            $('#output').on('click', function(){
                search_win = window.open('/qr/show', null, 'width=960 , height=895');
                return false;
            });
        });
    </script>
@endsection