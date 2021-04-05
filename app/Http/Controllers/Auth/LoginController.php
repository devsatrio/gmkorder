<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\moodels\AdminLogModel;
use Auth;
use DB;
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
    protected $redirectTo = '/backend/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        DB::table('log_admin')->insert([
            'user_id'=>Auth::user()->id,
            'tgl'=>date('Y-m-d'),
            'jam_login'=>date('H:i:s')
        ]);
       return redirect()->intended($this->redirectPath())->with('status', 'Login Success, Welcome Back '.Auth::user()->level.' '.Auth::user()->name);
    }
    public function username()
    {
        return 'username';
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $datalog = DB::table('log_admin')->where([['user_id','=',Auth::user()->id],['tgl','=',date('Y-m-d')]])->orderby('id','desc')->limit(1)->get();
        foreach($datalog as $dlog){
            DB::table('log_admin')
            ->where('id',$dlog->id)
            ->update([
                'jam_logout'=>date('H:i:s'),
            ]);
        }
        
    $this->guard()->logout();

    $request->session()->invalidate();

    return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
        $this->username() => 'required|string',
        'password' => 'required|string',
        'g-recaptcha-response' => 'required|captcha',
        ]);
    }
}