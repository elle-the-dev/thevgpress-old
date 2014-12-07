<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class ForumBoard extends Eloquent implements SluggableInterface {

    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_boards';

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug'
    );

    /**
     * Forum topics belonging to the forum board
     * @return array
     */
    public function topics()
    {
        return $this->hasMany('ForumTopic')
            ->orderBy('last_commented_at', 'desc');
    }

}
