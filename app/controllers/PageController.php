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

    /**
     * Sends back response dependent on type of request
     * @param string    $redirect
     */
    public function post($redirect=null, $refresh=true)
    {
        if (Request::ajax())
        {
            $merge = is_null($redirect)
                ? array('refresh' => $refresh) 
                : array('redirect' => $redirect);

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
            return Redirect::to(is_null($redirect) 
                ? Request::server('HTTP_REFERER') 
                : $redirect)->withInput();
        }
    }

}
