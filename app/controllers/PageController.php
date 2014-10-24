<?php
class PageController extends BaseController {

    protected $layout = 'main';

    /**
     * Sends back response dependent on type of request
     * @param string    $redirect
     */
    public function post($redirect)
    {
        return Request::ajax() ? json_encode(Messages::all()) : Redirect::to($redirect)->with('messages', self::all());
    }


}
