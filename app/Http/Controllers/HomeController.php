<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function index()
    {
        return view('index');
    }
}
