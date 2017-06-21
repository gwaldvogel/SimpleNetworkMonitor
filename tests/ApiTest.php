<?php

use \App\Console\Commands\NetworkMonitoringDaemon;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * @author Gregor Waldvogel <gregor@waldvogel.io
 * @copyright (C) 2017. All rights reserved.
 */
class ApiTest extends TestCase
{
    public function testStatus()
    {
        $tests = config('app.connection_tests');
        $time = Carbon::now()->toIso8601String();
        Cache::forever(NetworkMonitoringDaemon::getCacheName($tests[0][2]), ['name' => $tests[0][2], 'ip' => $tests[0][0], 'port' => $tests[0][1], 'status' => true, 'time' => $time, 'error' => 'No errors occured']);
        $this->get('/api/status')
            ->seeJsonEquals([
                    ['name' => $tests[0][2], 'ip' => $tests[0][0], 'port' => $tests[0][1], 'status' => true, 'time' => $time, 'error' => 'No errors occured'],
            ]);
    }
}
