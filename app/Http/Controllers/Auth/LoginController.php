<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LoginController extends Controller
{
    use ThrottlesLogins;
    /**
     * @var array
     */
    private $data = [];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param LoginRequest $request
     * @return bool
     * @throws ValidationException
     */
    public function login(LoginRequest $request): bool
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['phone', 'password'])
        // $request->filled('remember')
        );

        if ($authenticate) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            //return redirect()->intended(route('cabinet.home'));
            session()->flash('success', __('Welcome') . auth()->user()->name);
            return true;
        }

        $this->incrementLoginAttempts($request);
        // Неверный логин или пароль
        throw ValidationException::withMessages(['password' => [trans('auth.failed')]]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }

    /**
     * @return string
     */
    protected function username(): string
    {
        return 'phone';
    }
}
