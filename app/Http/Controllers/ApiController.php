<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Console\Commands\NetworkMonitoringDaemon;

class ApiController extends Controller
{
    public function getStatus()
    {
        $tests = config('app.connection_tests');
        $return = [];
        foreach ($tests as $test) {
            $result = Cache::get(NetworkMonitoringDaemon::getCacheName($test[2]));
            if ($result) {
                $return[] = $result;
            }
        }

        return response()->json($return);
    }
}
