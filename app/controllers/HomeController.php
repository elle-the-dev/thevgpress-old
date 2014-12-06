<?php
class HomeController extends PageController {

    public function showWelcome()
    {
        $this->layout->title = "Welcome";
        $this->layout->heading = "Latest Gaming News";
        $this->layout->content = View::make('index');

        $board = ForumBoard::find(1);
        $topics = $board->topics;
        //$topics[0]->lastPost();
    }

}
