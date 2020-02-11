@extends('layouts.qrbase')
@section('content')
    <div class="uk-margin">
        @if (!empty($arr) && count($arr))
            @foreach ($arr as $i => $a)
            <div class="inlineQR">
                {!!$a[1]!!}
                <br>
                <br><br>
                <div class="uk-flex uk-flex-center">{{$a[0]}}</div>
                
            </div>
                
                @if (($i + 1) % 6 == 0)
                    <br>
                @endif
            @endforeach
   
        @endif
    </div>
    <style>
        .inlineQR {
            display: inline-block;
            padding: 30px;
            border:dotted #F0F0F0 1px;
        }
    </style>
@endsection