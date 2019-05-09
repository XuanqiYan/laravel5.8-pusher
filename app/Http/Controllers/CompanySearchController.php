<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
class CompanySearchController extends Controller
{
    public function search(Request $request){
        
        return response()->json([
            'result'=>Company::search($request->text)->get()
        ],200);
    }
}
