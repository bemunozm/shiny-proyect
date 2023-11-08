<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);
    
        if(Auth::attempt($attributes))
        {
            session()->regenerate();
    
            // Comprobar el tipo de usuario
            $userType = Auth::user()->type;
    
            if($userType == 'Empresa') {
                
                return redirect()->route('company.index');
            } elseif($userType == 'Postulante') {
                return redirect('dashboard');
            } else {
                // En caso de que no haya un tipo válido, redirige al dashboard por defecto
                return dd('HOLA');
            }
        }
        else{
            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
