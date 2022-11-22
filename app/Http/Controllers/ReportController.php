<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        return Report::create($input);
    }
}
