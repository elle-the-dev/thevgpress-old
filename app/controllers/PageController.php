<?php
/**
 * PageController class
 */

/**
 * Top-level controller for displaying pages
 */
class PageController extends BaseController {

    /** layout view */
    protected $layout = 'main';
    protected $user;

    /**
     * default constructor
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * sends back response dependent on type of request
     *
     * @param string    $redirect
     */
    public function post($redirect=null, $refresh=true)
    {
        if (Request::ajax())
        {
            // in event of AJAX post, we want to return JSON

            $merge = is_null($redirect)
                ? array('refresh' => $refresh) 
                : array('redirect' => $redirect);

            // clear messages only in the case of having errors
            // success messages are accompanied by redirect
            $messages = Messaging::has('errors') 
                ? Messaging::all() 
                : Messaging::all(false);

            return json_encode(
                array_merge(
                    $messages ?: array(),
                    $merge
                )
            );
        }
        else
        {
            // if not by AJAX, gotta send them somewhere
            // back from whence they came if no redirect specified
            return Redirect::to(
                is_null($redirect) 
                ? Request::server('HTTP_REFERER') 
                : $redirect
            )->withInput();
        }
    }

}
