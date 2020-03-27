<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  Laravel\Socialite\Facades\Socialite;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            if (!$this->checkUser($user)) {
                return redirect()->route('index')->with([
                    'message' => 'Email của bạn không được phép truy cập vào hệ thống',
                    'alert' => 'alert-danger'
                ]);
            }

            $contentImageAvatar = $this->fileGetContentsFromUrl($user->getAvatar());
            file_put_contents('source/img/user/' . str_replace(" ", "_", $user->getName()) . ".jpg",
                $contentImageAvatar);

            $userCheck = $this->createUser($user);
            Auth::login($userCheck);

            return redirect()->route('home')->with([
                'message' => 'Bạn đã đăng nhập thành công',
                'alert' => 'alert-success'
            ]);

        } catch (\Exception $e) {
            report($e);
            return redirect()->route('index');
        }
    }

    public function checkUser($user)
    {
        if (!isset($user->user['hd']) || $user->user['hd'] !== config('constant.email')) {
            return false;
        }

        return true;
    }

    public function createUser($user)
    {
        $userCheck = User::where('email', $user->getEmail())->get()->first();
        if ($userCheck) {
            return $userCheck;
        }

        $newUser = new User();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->avatar = str_replace(" ", "_", $user->getName()) . ".jpg";
        $newUser->nickname = $user->getNickname();
        $newUser->save();

        return $newUser;
    }

    function fileGetContentsFromUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
