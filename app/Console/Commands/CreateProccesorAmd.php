<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Amd\Http\Controllers\AmdController;

class CreateProccesorAmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amd:processors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update processor amd.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return (new \Modules\Amd\Http\Controllers\AmdController)->processorUpdateOrCreate();
    }
}
