<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class AdminLogController extends Controller
{
    public function index()
    {
        $logs = Log::all();
        return view('admin.logs.index', compact('logs'));
    }
}
