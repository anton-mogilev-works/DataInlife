<?php

namespace App\Console\Commands;

use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Console\Command;

class CheckUserExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user group expiration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                $this->info($user->id . " " . $user->name);
                $groups = $user->groups;
                if ($groups->count() > 0) {
                    foreach ($groups as $group) {
                        $this->info("\t" . $group->name . " истекает " . strval($group->pivot->expired_at));

                        $wrong_date_time = $group->pivot->expired_at == '';

                        try {
                            $expired_at = new DateTime($group->pivot->expired_at);

                            if ((new DateTime()) > $expired_at || $wrong_date_time) {
                                $user->groups()->find($group->id)->pivot->delete();
                                $res = $user->saveOrFail();

                                if ($res == true) {
                                    $this->info('Пользователь ' . $user->name . ' удалён из группы ' . $group->name);
                                }
                            }

                        } catch (Exception $e) {

                            $user->groups()->find($group->id)->pivot->delete();
                            $res = $user->saveOrFail();

                            if ($res == true) {
                                $this->info('Время пребывания пользователя в группе задано некорректно');
                                $this->info('Пользователь ' . $user->name . ' удалён из группы ' . $group->name);
                            }
                        }
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}