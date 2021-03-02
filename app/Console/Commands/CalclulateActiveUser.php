<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CalclulateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ue4bbs:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成活跃用户';

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
    public function handle(User $user)
    {
        $user->cacheActiveUsers();
        $this->info('生成活跃用户成功！');
    }
}
