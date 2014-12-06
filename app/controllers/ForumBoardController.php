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
    public function forumBoard($slug)
    {
        $board = ForumBoard::where('slug', $slug)->first();

        if (is_null($board))
            throw new NotFoundHttpException;

        $this->layout->title = $board->title;
        $this->layout->heading = $board->title;
        $this->layout->content = View::make(
            'forum-board',
            array(
                'board' => $board,
            )
        );
    }

}
