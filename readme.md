# SimpleNetworkMonitor

This project was born on a weekend where my internet access got restricted due to a firewall malfunction.
I created this simple network monitor to run permanently on a Raspberry Pi.
It is basically constantly checking a list of predefined IPs/Hostnames and Ports (TCP only).



## Usage

- Download the source code
- Install dependencies via Composer
- Copy the .env.example file, make sure you have a local redis server up and running.
- Run the daemon with `php artisan monitor` (Use screen or supervisor for optimal results)

## Configuration
You can adapt the list of checked Hosts in config/app.php

## Optimal Setup
I am running (and testing) this on a Raspberry Pi 3 running Raspbian Jessie Lite with Apache and PHP 5.6.


## License

SimpleNetworkMonitor is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
