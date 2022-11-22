<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetVipUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reset-vip-user';

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
     * @return int
     */
    public function handle()
    {
        $list = User::where('vip_expried', '!=', null)->get();
        $now = Carbon::now();
        foreach($list as $item) {
            if($item->vip_expried < $now) {
                $item->update(['vip_expried' => null, 'vip' => 0]);
            }
        }
    }
}
