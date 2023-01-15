<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Intel\Http\Controllers\IntelProcessorsController;

class CreateElementIntel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'intel:element';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update product intel.';

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
     *
     * Execute the console command.
     *
     * @throws \Throwable
     */
    public function handle(): ?bool
    {
        return (new \Modules\Intel\Http\Controllers\IntelProcessorsController)->elementIntelCreateOrUpdate();
    }
}
