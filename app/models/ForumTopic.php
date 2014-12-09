<?php
class ForumTopic extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_topics';

    /**
     * User who created the topic
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Forum Topic comments
     *
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    /**
     * The OP comment in a forum topic
     *
     * @return Comment
     */
    public function firstComment()
    {
        $comments = $this->comments();
        return $comments
            ? $comments->orderBy('created_at', 'desc')->take(1)->first()
            : null;
    }

    /**
     * The most recent comment in a forum topic
     *
     * @return Comment
     */
    public function lastComment()
    {
        $comments = $this->comments();
        return $comments 
            ? $comments->orderBy('created_at')->take(1)->first()
            : null;
    }

    /**
     * Comments not not having been seen by the user yet
     *
     * @return mixed
     */
    public function unread()
    {
        if (Auth::guest())
            return $this->comments();

        $user = Auth::user();
        return $this->hasMany('ForumTopicRead')
            ->where('user_id', $user->id);
    }

    /**
     * Up and down likes sum 
     */
    public function likes($formatted=false)
    {
        return $this->firstComment()->likes($formatted);
    }

}
