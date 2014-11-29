<?php
/**
 * Forum Board controller
 */

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Display of topics within a board
 */
class ForumBoardController extends PageController {

    /**
     * registration form
     */
    public function forumBoard($id)
    {
        $board = ForumBoard::find($id);

        if (is_null($board))
            throw new NotFoundHttpException;

        $topics = $board->topics;

        $this->layout->title = $board->title;
        $this->layout->heading = $board->title;
        $this->layout->content = View::make(
            'forum-board',
            array(
                'topics' => $topics
            )
        );
    }

}
