<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\UserGroup;
use DateTime;

class UserGroupObserver
{
    /**
     * Handle the UserGroup "created" event.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return void
     */
    public function created(UserGroup $userGroup)
    {

        $group = Group::find($userGroup->group_id);
        
        if($group instanceof Group)
        {
            $expire_hours = $group->expire_hours;
            $expired_at = new DateTime();
            $userGroup->expired_at = $expired_at->modify('+' . $expire_hours . ' hours');
            $userGroup->save();
        }
        
    }

    /**
     * Handle the UserGroup "updated" event.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return void
     */
    public function updated(UserGroup $userGroup)
    {     

        
    }

    /**
     * Handle the UserGroup "deleted" event.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return void
     */
    public function deleted(UserGroup $userGroup)
    {
        //
    }

    /**
     * Handle the UserGroup "restored" event.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return void
     */
    public function restored(UserGroup $userGroup)
    {
        //
    }

    /**
     * Handle the UserGroup "force deleted" event.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return void
     */
    public function forceDeleted(UserGroup $userGroup)
    {
        //
    }
}
