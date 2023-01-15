<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateElementAmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amd:element';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return (new \Modules\Amd\Http\Controllers\AmdController)->elementUpdateOrCreate();
    }
}
