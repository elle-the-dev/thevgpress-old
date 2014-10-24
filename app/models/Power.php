<?php
class Power extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'powers';

    public function groups()
    {
        return $this->belongsTo('Group');
    }

}
