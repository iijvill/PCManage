<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>

    <!-- Styles -->
    <link rel="preload" href="{{asset('css/app.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/app.css') }}"></noscript>

        
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alert.js')}}" defer></script>
</head>
<body>
    <div class="uk-section">
        <div class="uk-child-width-expand uk-flex uk-flex-center" uk-grid>
            <div class="uk-margin-large-left uk-margin-large-right uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form action="/login/send" method="POST" class="uk-form-horizontal uk-margin-small">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="uk-card-title">管理者ログイン</div>
                        <div class="uk-margin">
                            <label class="uk-form-label">メールアドレス</label>
                            <div class="uk-form-controls">
                                <input type="email" class="uk-input" name="email">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label">パスワード</label>
                            <div class="uk-form-controls">
                                <input type="password" class="uk-input" name="password">
                            </div>
                        </div>
                        <button class="uk-button uk-button-primary uk-button uk-box-shadow-large">ログイン</button>

                    </form> 
                </div>
                <br><br>
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">
                    <form id="formCreate" action="/regist" method="POST" class="uk-form-horizontal uk-margin-small">
                        {{ csrf_field() }}
                        <div class="uk-form-controls">
                                <input type="email" class="uk-input" name="email">
                                <input type="password" class="uk-input" name="password">
                        </div>
                        <button class="uk-button uk-button-primary uk-button uk-box-shadow-large">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            submitAlert({form_id:'formCreate', dialog_title:'メールアドレスを登録します', dialog_text:'よろしいですか？', dialog_finish_title:'登録しました', dialog_finish_text:'', redirect_flg:true, redirect_url:'/login'});
        });
    </script>
</body>
</html>