<?php
class Comment extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function votes()
    {
        return $this->hasMany('CommentSetting')->sum('vote');
    }

}
