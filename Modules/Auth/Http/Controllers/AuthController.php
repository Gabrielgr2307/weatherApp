<?php
namespace Modules\Auth\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /**
     * Mostrar el formulario de inicio de sesión.
     *
     * @return Renderable
     */
    public function showLogin()
    {
        return view('auth::login');
    }
    /**
     * Manejar la solicitud de inicio de sesión.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(['email' => 'Las credenciales no son válidas.']);
    }
    /**
     * Manejar la solicitud de cierre de sesión.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
