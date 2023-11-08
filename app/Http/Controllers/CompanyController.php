<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Replacement;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->id();
        $company = Company::where('user_id', $user_id)->first();
        $replacements = Replacement::where('company_id', $company->id)->with('resumes')->get();

    // Ahora, obtenemos los últimos resumes de todos los replacements
    // Esto supone que tienes una relación 'resumes' definida en tu modelo Replacement
    $latestApplicants = $replacements->flatMap(function ($replacement) {
        return $replacement->resumes;
    })->take(10); // Obtiene los últimos 10 postulados

    return view('index', compact('user_id', 'company', 'latestApplicants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        Company::create([
            'name' => $request->name,
            'corporate_name' => $request->corporate_name,
            'tax' => $request->tax,
            'document' => $request->document,
            'verifier_code' => $request->verifier_code,
            'street_name' => $request->street_name,
            'number' => $request->number,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'industry' => $request->industry,
            'user_id' => $user_id,
        ]);

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update([
            'name' => $request->name,
            'corporate_name' => $request->corporate_name,
            'tax' => $request->tax,
            'document' => $request->document,
            'verifier_code' => $request->verifier_code,
            'street_name' => $request->street_name,
            'number' => $request->number,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'industry' => $request->industry
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

    public function profile(){
        $user_id = auth()->id();
        $id = User::find($user_id);
        $company = Company::where('user_id', $id)->first();
        return view('company-profile', compact('company', 'id'));
    }
}
