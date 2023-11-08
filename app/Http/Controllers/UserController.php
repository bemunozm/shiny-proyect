<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Resume;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_id = auth()->id();
        $id = User::find($current_id);
        $resume = Resume::where('user_id', $current_id)->first();
        // Usando la función now()
        $fechaActual = now();

        // O usando Carbon::now()
        $fechaActual = Carbon::now();
        
        return view('laravel-examples/user-profile', compact('resume', 'id', 'current_id', 'fechaActual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
    
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $current_id = auth()->id();
        $id = User::find($user);
        $resume = Resume::where('user_id', $user)->first();
        return view('laravel-examples/user-profile', compact('resume', 'id', 'current_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {  
        $user_id = User::find($id);
        $user_id->update([
            'document_type' => $request->document_type,
            'document' => $request->document,
            'verifier_code' => $request->verifier_code,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status
        ]);
        return redirect()->route('user-profile.index');
    }

    public function update_company(Request $request, $id)
    {  
        $user_id = User::find($id);
        $user_id->update([
            'document_type' => $request->document_type,
            'document' => $request->document,
            'verifier_code' => $request->verifier_code,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status
        ]);
        return redirect()->route('company-profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showApplications()
{
    $userId = auth()->id();
    $user = User::with('resume.replacements')->find($userId);

    $applications = optional($user->resume)->replacements ?? collect();

    return view('postulaciones', compact('applications'));
}
    
}
