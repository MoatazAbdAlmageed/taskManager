<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $schemaName = $this->argument('name');

        $charset = config('database.connections.mysql.charset');
        $collation = config('database.connections.mysql.collation');

        // Create a new database connection configuration
        $defaultConnection = config('database.connections.mysql');
        $defaultConnection['database'] = null; // Set database to null

        // Temporarily use the connection to create the database
        Config::set('database.connections.temp_connection', $defaultConnection);

        DB::connection('temp_connection')->statement("CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;");

        $this->info("Database '$schemaName' created successfully.");

        // Reset the connection to the default database
        Config::set('database.connections.temp_connection', null);
    }
}
