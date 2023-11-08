<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;

class AutocompleteController extends Controller
{
    public function searchEducation(Request $request)
    {
        $query = $request->get('query');
        $filterResult =  Education::where('career', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }
}
