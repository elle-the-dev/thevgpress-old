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
	protected $hidden = array('remember_token');

    /**
     * The attributes autofillable from the join form
     *
     * @var array
     */
    protected $fillable = array('username', 'password', 'email');

    /** used for validation, not to be stored in database */
    public $password_confirmation = null;

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
        return !is_null(Group::powers()->whereIn('group_id', $this->groups)
            ->where('powers.key', $key)
            ->where('user_id', $this->id)
            ->first());
    }

    /**
     * Legacy function for hashing passwords
     */
    public static function hashPassword($password)
    {
        return sha1("Please Do not ".md5(sha1($password))." crack my site");
    }

    /**
     * Validate User data - used in Observer
     */
    public function validate()
    {
        $rules = array(
            'username' => 'required|alpha_dash|max:30',
            'password' => 'required|min:6|confirmed',
            'email'    => 'email'
        );

        if (!$this->id)
            $rules['username'] .= '|unique:users';

        $data = $this->toArray();
        $data['password_confirmation'] = $this->password_confirmation;
        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails())
        {
            return $validator->messages();
        }

        return true;
    }

}
