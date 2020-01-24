<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Model\Admin;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/show';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        if(Auth::guard('admin')->check()){
            return redirect('/show');
        }
        return view('manage.login');
    }



    public function login(Request $request){
        $this->validateLogin($request);

        //ログインを試みる→成功ならifの中に処理が進む
       
        if($this->attemptLogin($request)){
            //認証OKとなり、上の方に書いてある$redirectToに記載のルートにリダイレクトする
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function regist(Request $request){
        $remember_token = session_create_id();

        $email = $request->input('email');

        $password = $request->input('password');

        $this->validate($request, [
            'password' => 'required|max:255|check_contain_space',
            'email'    => 'required|email|unique:admins,email',
        ]);

        $admin = new Admin();
        $admin->email = $email;
        $admin->password = bcrypt($password);   //暗号化〜
        $admin->remember_token = $remember_token;
        $admin->save();


        return null;
    }


    //ログアウト処理
    public function logout(Request $request){

        $this->guard()->logout();   //これでログアウト

        return redirect('/show');
    }


    //認証に用いる方式(?)を決めるよ！(ガードのカスタマイズ)auth.phpを参照
    protected function guard()
    {
        return Auth::guard('admin');
    }   

    //認証に使うカラムを設定
    public function username(){
        return 'email';
    }


    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'bail|required|string|max:255|exists:admins|check_approved',
            'password' => 'bail|required|string',
        ]);
    }
}
