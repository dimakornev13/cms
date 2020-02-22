<?php

namespace M0xy\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'm0xycms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


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
        DB::table('settings')->insert([
            'key' => 'site.metrics',
            'display_name' => 'metrics',
            'value' => '',
            'details' => null,
            'type' => 'text_area',
            'order' => 6,
            'group' => 'Site'
        ]);

        echo 'DONE';
    }
}
