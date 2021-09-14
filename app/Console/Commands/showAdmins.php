<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class showAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all admins';

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
     * @return int
     */
    public function handle()
    {
        $this->table(
            ['Name', 'Mobile', 'Email'],
            User::where('isAdmin', '=', '1')->select(['name', 'mobile', 'email'])->get()->toArray()
        );
    }
}
