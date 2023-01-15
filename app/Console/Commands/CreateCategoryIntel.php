<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateCategoryIntel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'intel:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update category intel.';

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
        return (new \Modules\Intel\Http\Controllers\IntelProcessorsController)->categoriesCreateOrUpdate();
    }

}
