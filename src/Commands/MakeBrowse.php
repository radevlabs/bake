<?php

namespace Radevlabs\Bake\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bake:browse {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make browse';

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
        dd($this->arguments());
    }
}
