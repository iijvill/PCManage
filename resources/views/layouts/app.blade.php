<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alert.js')}}" defer></script>

    {{-- テーブルソートのjs --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <!-- Fonts -->

    <!-- Styles -->
    <link rel="preload" href="{{asset('css/app.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/app.css') }}"></noscript>
</head>
<body>
    @if (!empty(Auth::guard('admin')->check()))
        <div class="uk-container uk-container-expand" style="background:#4d4d4d;" uk-sticky="bottom: #offset">
    @else
        <div class="uk-container uk-container-expand" style="background:#232323;" uk-sticky="bottom: #offset">
    @endif
    <nav class="uk-navbar" uk-navbar>
        <div class="uk-navbar-left">
            <img data-src="logo.png" width="80" height="80" alt="" uk-img>
            <ul class="uk-navbar-nav">
                <li><a href="{{config('const.path_show')}}">PC一覧</a></li>
            </ul>
            @if (!empty(Auth::guard('admin')->check()))
                @if (!empty($mode) && count($mode) != 0)
                    @if ($mode[0]->run == 0)
                        <ul class="uk-navbar-nav">
                            <li><a href="{{config('const.path_employee')}}">使用者一覧</a></li>
                        </ul>
                    @endif
                @endif
                <ul class="uk-navbar-nav">
                    <li><a href="{{config('const.path_modechange')}}">システムモード管理</a></li>
                    <li><a href="/qr/verify">QRコード表示</a></li>
                </ul>
                @if ($mode[0]->run != 1)
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#">情報変更</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a href="/department">所属</a></li>
                                    <li><a href="/pctype">筐体</a></li>
                                    <li><a href="/pcmaker">PCメーカー</a></li>
                                    <li><a href="/os">OS</a></li>
                                    <li><a href="/cpu">CPU</a></li>
                                    <li><a href="/antivirus">ウイルス対策</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                @endif
            @endif
        </div>
        <div class="uk-navbar-right">
            <div class="uk-navbar-item">
                @if (!empty($pc_counts))
                    総数:{{$pc_counts}}
                @endif
            </div>
            <div class="uk-navbar-item">
                @if (!empty($pcstock_counts))
                    ストック:{{$pcstock_counts}}
                @endif
            </div>
            @if (!empty(Auth::guard('admin')->check()))
                @if (!empty($mode) && count($mode) != 0)
                    <div class="uk-navbar-item">
                        <a class="uk-button uk-button-default" href="/stockcheck" style="color:#dc4916">棚卸し状況</a>
                    </div>
                @endif
                <div class="uk-navbar-item">
                    <a href="/logout">ログアウト</a>
                </div>
            @endif
            <div class="uk-navbar-item">
                <a href="/login" class="uk-icon" uk-icon="icon: gitter"></a>
            </div>
        </div>
    </nav>
    </div>
    @if (!empty($mode) && count($mode) != 0)
        @if ($mode[0]->run == 1)
            <div>
                <h5 style="position:relative; background:#dc4916; color:#212529;">〜棚卸し中〜　作業中は各情報の追加・変更ができません</h5>
            </div>
        @endif
    @endif
    <div>
        @yield('content')
    </div>
    <style>
        .sort.desc:after {
            content:"▼";
        }
        .sort.asc:after {
            content:"▲";
        }
    </style>

</body>
</html>
