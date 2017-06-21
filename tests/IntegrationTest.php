<?php

use \Illuminate\Support\Facades\Artisan;

/**
 * @author Gregor Waldvogel <gregor@waldvogel.io
 * @copyright (C) 2017. All rights reserved.
 */
class IntegrationTest extends TestCase
{
    public function testDaemonAndApi()
    {
        Artisan::call('monitor', ['-o' => 'true']);
        $this->get('/api/status')
            ->seeJsonStructure([
                '*' => ['name', 'ip', 'port', 'status', 'time', 'error']
            ]);
    }
}