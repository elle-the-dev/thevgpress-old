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
     * registration form
     */
    public function forumTopic($boardSlug, $topicSlug)
    {
        $topic = ForumTopic::where('slug', $topicSlug)->first();

        if (is_null($topic))
            throw new NotFoundHttpException;

        $this->layout->title = $topic->title;
        $this->layout->heading = $topic->title;
        $this->layout->content = View::make(
            'forum-topic',
            array(
                'topic' => $topic
            )
        );
    }

}
