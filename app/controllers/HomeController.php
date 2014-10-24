<?php
class HomeController extends PageController{

    public function showWelcome()
    {
        $this->layout->title = "Welcome";
        $this->layout->content = View::make('index');
    }

}
