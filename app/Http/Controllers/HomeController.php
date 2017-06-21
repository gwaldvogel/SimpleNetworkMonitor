<?php

namespace App\Http\Controllers;

use App\Datatypes\EventTypes;
use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function index()
    {
        return view('index');
    }
}
