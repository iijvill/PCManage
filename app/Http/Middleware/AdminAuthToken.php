<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Model\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminAuthToken extends Controller
{
    /**
     * Handle an incoming request.
     * 管理者ログインの自作ミドルウェア
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    //認証済みかどうかチェック
    public function handle($request, Closure $next)
    {

        if(Auth::guard('admin')->check()){
            //認証済みなら
            //adminテーブルのlogin_dateを更新
            $update = Admin::where('email', Auth::guard('admin')->user()->email)
            ->update([
                'login_date' => Carbon::now(),
            ]);
            return $next($request);
        }

        $db_data = null;

        $simpleToken = $request->route()->parameter('token');
        // dd($simpleToken);
        if(empty($db_data)){
            return redirect('/show');
        }


        Auth::guard('admin')->loginUsingId($db_data->id, true);

        $update = Admin::where('id', $db_data->id)
        ->update([
            'login_date' => Carbon::now(),
        ]);


        //認証済なら管理画面ログイン後のトップページへ
        return $next($request);
    }
}
