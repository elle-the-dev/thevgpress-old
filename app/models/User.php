<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * The groups the user belongs to 
     */
    public function groups()
    {
        return $this->belongsTo('Group');
    }

    /**
     * The powers the user has
     */
    public function powers()
    {
        $groupIds = GroupUser::where('user_id', $this->id)->lists('group_id');
        $powerIds = GroupPower::whereIn('group_id', $groupIds)->lists('power_id');
        return Power::whereIn('id', $powerIds);
    }

    /**
     * If the user has a power with the given key
     */
    public function hasPower($key)
    {
        return !!Group::powers()->whereIn('group_id', $this->groups)
            ->where('powers.key', $key)
            ->where('user_id', $this->id)
            ->first();
    }

}
