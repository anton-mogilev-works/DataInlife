<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Group;

class SetUserGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавление пользователя в группу';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_id = $this->ask('Введите id пользователя: ');
        $group_id = $this->ask('Введите id группы: ');

        $user_id = intval($user_id);
        $group_id = intval($group_id);

        $result = Command::FAILURE;

        if ($user_id > 0 && $group_id > 0) {
            $user = User::find($user_id);
            $group = Group::find($group_id);

            if ($user instanceof User && $group instanceof Group) {
                $this->info("Пользователь : " . $user->name);
                $this->info("Группа       : " . $group->name);

                if ($user->groups()->find($group_id) instanceof Group == false) {
                    $user->groups()->attach($group_id);
                    if($user->active === false)
                    {
                        $user->active = true;
                    }
                    $saveRes = $user->saveOrFail();

                    if ($saveRes === true) {
                        $result = Command::SUCCESS;
                    }                    
                }
                else {
                    $this->alert("Пользователь " . $user->name . ' уже добавлен в группу ' . $group->name);
                }
            }
        }

        return $result;
    }
}