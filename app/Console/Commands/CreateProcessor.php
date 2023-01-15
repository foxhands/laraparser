<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateProcessor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processor:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processors create';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        return (new \Modules\Parser\Http\Controllers\ParserController)->parseProcessors();

    }
}
