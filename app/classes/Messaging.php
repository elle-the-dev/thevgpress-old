<?php
/**
 * Messaging class
 */

/**
 * Message handling and response
 */
class Messaging {

    /**
     * Add a message to the session
     * @param string    $type       the type of message (error/success/info)
     * @param string    $message    the message
     */
    public static function add($type, $message)
    {
        $messages = Session::get('messages') ?: new ReportBag();
        $messages->add($type, $message);
        Session::put('messages', $messages);
    }

    /**
     * Retrieve messages from the session
     * @param string    $type       the type of messages to retrieve (error/success/info)
     * @param bool      $clear      whether to delete messages after retrieving
     * @return mixed    array or json string
     */
    public static function get($type, $clear=true)
    {
        $messages = Session::get('messages');
        $messagesArray = $messages->get($type);
        if ($clear)
        {
            $messages->delete($type);
            Session::put('messages', $messages);
        }
        return $messagesArray;
    }

    /**
     * Retrieve all messages
     * @param bool      $clear  whether to delete messages after retrieving
     * @return mixed    array or json string
     */
    public static function all($clear=true)
    {
        $messages = Session::get('messages');
        if ($clear)
            Session::forget('messages');
        return $messages instanceof ReportBag ? $messages->toArray() : null;
    }

    /**
     * true/false if there are message of the given type
     * @param string    $type
     * @return bool
     */
    public static function has($type)
    {
        return Session::get('messages')->has($type);
    }

}
