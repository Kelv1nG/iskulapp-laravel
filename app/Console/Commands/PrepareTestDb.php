<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PrepareTestDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prepare-test-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Config::set('app.env', 'testing');
        // Config::set('database.default', 'testing');

        $this->call('optimize:clear', ['--env' => 'testing']);
        $this->call('migrate:fresh', [
            '--seed' => true,
            '--database' => 'testing']
        );
    }
}
