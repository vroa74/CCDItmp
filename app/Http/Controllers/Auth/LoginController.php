<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $this->ensureUserIsActive($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Verificar que el usuario con las credenciales dadas no esté inactivo.
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function ensureUserIsActive(Request $request)
    {
        $user = User::where('email', $request->input('email'))
            ->where('rfc', $request->input('rfc'))
            ->first();

        if ($user && ! $user->status) {
            throw ValidationException::withMessages([
                'email' => ['El usuario está inactivo. Contacte al administrador.'],
            ]);
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'rfc', 'password');

        // Verificar que tanto email como RFC coincidan
        return Auth::attempt([
            'email' => $credentials['email'],
            'rfc' => $credentials['rfc'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'));
    }

    /**
     * Get the failed login response instance.
     *
     * @return Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
            'rfc' => [trans('auth.failed')],
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @return RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo);
    }

    /**
     * Validate the user login request.
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'rfc' => 'required|string|max:13',
            'password' => 'required|string',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
