<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function index()
    {
        return view('index');
    }
}
