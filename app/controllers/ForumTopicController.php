<?php
/**
 * Forum Board controller
 */

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Display of topics within a board
 */
class ForumTopicController extends PageController {

    /**
     * List comments within a given forum topic
     */
    public function forumTopic($boardSlug, $topicSlug)
    {
        $topic = ForumTopic::where('slug', $topicSlug)->first();

        if (is_null($topic))
            throw new NotFoundHttpException;

        $this->layout->title = $topic->title;
        $this->layout->heading = $topic->title;
        $this->layout->styles = array(
            'css/bootstrap-toggle.min.css',
            'css/forum-topic.css',
            'css/bootstrap-wysihtml5.css'
        );
        $this->layout->scripts = array(
            'js/bootstrap-toggle.min.js',
            'js/wysihtml5.min.js',
            'js/bootstrap3-wysihtml5.js',
            'js/wysihtml5-bgColor.js',
            'js/comment.js'
        );
        $this->layout->content = View::make(
            'forum-topic',
            array(
                'topic' => $topic
            )
        );
    }

}
