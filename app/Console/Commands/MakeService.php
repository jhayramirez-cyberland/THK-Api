<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path('Services/' . $name . '.php');

        if (file_exists($servicePath)) {
            $this->error('Service already exists!');
            return;
        }

        $serviceStub = file_get_contents(__DIR__ . '/stubs/service.stub');
        $serviceStub = str_replace('{{ServiceName}}', $name, $serviceStub);

        file_put_contents($servicePath, $serviceStub);

        $this->info('Service created successfully!');
    }
}
