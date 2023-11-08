<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
        $request['password'] = bcrypt($request['password'] );

        

        session()->flash('success', 'Your account has been created.');
        $user = User::create($request->all());
        Auth::login($user); 

        if($user->type == 'Empresa') {
            return redirect()->route('company.create')->with(['success'=>'You are logged in.']);
        } elseif($user->type == 'Postulante') {
            Resume::create([
                'user_id' => $user->id,
            ]);
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        } else {
            // En caso de que no haya un tipo válido, redirige al dashboard por defecto
            return dd('HOLA')->with(['success'=>'You are logged in.']);
        }
    }
}
