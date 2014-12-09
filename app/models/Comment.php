<?php
class Comment extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * User who created the comment
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Number of likes the 
     */
    public function likes($formatted=false)
    {
        $likes = $this->hasMany('CommentSetting')->sum('liked');

        if (!$formatted)
            return $likes;

        if ($likes > 0)
            $sign = '+';
        else if ($likes < 0)
            $sign = '-';
        else
            $sign = '';

        return $sign.$likes;
    }

}
