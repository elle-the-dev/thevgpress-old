<?php
class ForumTopic extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_topics';

    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('Comment', 'external_id');
    }

    public function lastPost()
    {
        $comments = $this->comments;
        return $comments ? $comments->max('created_at') : null;
    }

    public function replies()
    {
        return $this->comments()->count() - 1;
    }

    public function unread()
    {
        if (Auth::guest())
            return $this->comments()->count();

        $user = Auth::user();
        return $this->hasMany('ForumTopicRead')
            ->where('user_id', $user->id);
    }

    public function votes()
    {
        return 0;
    }

}
