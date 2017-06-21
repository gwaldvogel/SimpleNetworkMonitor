<?php

namespace App\Console\Commands;

use App\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class NetworkMonitoringDaemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor {--o|once}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts monitoring the network connection.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tests = config('app.connection_tests');

        $results = [];

        $this->info('Starting network monitoring...');

        while(true)
        {
            foreach($tests as $i => $testValues)
            {
                $connection = @fsockopen($testValues[0], $testValues[1], $errno, $errstr, 5);
                $status = false;
                if(is_resource($connection))
                {
                    $this->info('[' . $i . '] ' . $testValues[0] . ' Port ' . $testValues[1] . ' is open.');
                    fclose($connection);
                    $changed = (array_key_exists($i, $results) ? $results[$i] : false) != true ? true : false;
                    $results[$i] = true;
                    $status = true;
                }
                else
                {
                    $this->info('[' . $i . '] ' . $testValues[0] . ' Port ' . $testValues[1] . ' is closed.');
                    $changed = (array_key_exists($i, $results) ? $results[$i] : true) != false ? true : false;
                    $results[$i] = false;
                }

                if($changed)
                {
                    $this->info('Writing ' . self::getCacheName($testValues[2]) . ' into cache');
                    $error = $errno != 0 ? $errno . ': ' . $errstr : 'No errors occured';
                    Cache::forever(self::getCacheName($testValues[2]), ['name' => $testValues[2], 'ip' => $testValues[0], 'port' => $testValues[1], 'status' => $status, 'time' => Carbon::now()->toIso8601String(), 'error' => $error]);

                }
            }
            if($this->option('once'))
                break;
        }
    }

    public static function getCacheName($name)
    {
        return strtolower('test:' . str_replace('/', '_', str_replace(' ', ':', $name)));
    }

}
