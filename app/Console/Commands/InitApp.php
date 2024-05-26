<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class InitApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the application by running various setup tasks';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Starting application initialization...');

        // Step 1: Run composer install
        $this->runProcess('composer install');

        // Step 2: Generate Laravel application key
        Artisan::call('key:generate');
        $this->info('Application key generated.');

        // Step 3: Create the database
        Artisan::call('database:create', ['name' => 'taskManager']);
        $this->info('Database created.');

        // Step 4: Run migrations and seed data
        Artisan::call('migrate', ['--seed' => true]);
        $this->info('Database migrated and seeded.');

        // Step 5: Start the Laravel development server
        $this->runProcess('php artisan serve');

        $this->info('Application initialization complete.');
    }

    /**
     * Run a process and output the result.
     *
     * @param string $command
     * @return void
     */
    protected function runProcess($command)
    {
        $process = Process::fromShellCommandline($command);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
