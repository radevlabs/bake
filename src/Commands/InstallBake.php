<?php

namespace Radevlabs\Bake\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallBake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bake:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install bake admin package';

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
        $this->info('Installing Bake admin'.($this->option('force') ? ' (forced)...' : '...'));

        foreach (['asset', 'database', 'component'] as $tag){
            $this->info("Publishing bake $tag...");
            Artisan::call('vendor:publish', [
                '--tag' => $tag,
                '--force' => $this->option('force')
            ]);
            $tag = ucwords($tag);
            $this->info("$tag published");
        }

        $this->info('Enjoy :)');
    }
}
