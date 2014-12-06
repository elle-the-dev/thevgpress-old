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
     *
     * $type is is passed in the form of [basetype.target] where 
     * target indicates the target
     * HTML element ID to place the messages when needed.
     * For example, errors.errors-comments would look for an
     * element #errors-comments
     * while still being grouped under errors for message purposes
     *
     * @param string    $type       the type of message (error/success/info)
     * @param string    $message    the message
     */
    public static function add($type, $message)
    {
        $messages = Session::get('reportBag') ?: new ReportBag();
        $messages->add($type, $message);
        Session::put('reportBag', $messages);
    }

    /**
     * Retrieve messages from the session
     * @param string    $type       the type of messages to retrieve
     *                              (error/success/info)
     * @param bool      $clear      whether to delete messages after retrieving
     * @return mixed    array or json string
     */
    public static function get($type, $clear=true)
    {
        $messages = Session::get('reportBag');

        if (is_null($messages))
            return null;

        $messagesArray = $messages->get($type);
        if ($clear)
        {
            $messages->delete($type);
            Session::put('reportBag', $messages);
        }

        return $messagesArray;
    }

    /**
     * true/false if there are message of the given type
     * @param string    $type
     * @return bool
     */
    public static function has($type)
    {
        return Session::has('reportBag') 
            ? Session::get('reportBag')->has($type)
            : false;
    }

    /**
     * Retrieve all messages
     * 
     * Messages are returned in the form of
     * array ( [type] => array ( [target] => array ( [messages] ) ) )
     * where target is used for the target element ID to place the messages.
     *
     * @param bool      $clear  whether to delete messages after retrieving
     * @return mixed    array or json string
     */
    public static function all($clear=true)
    {
        $messages = Session::get('reportBag');
        if ($clear)
            Session::forget('reportBag');

        if ($messages instanceof ReportBag)
        {
            $return = array();
            foreach ($messages->toArray() as $key => $message)
            {
                if (strpos($key, '.') !== false)
                {
                    list($type, $target) = explode('.', $key);
                    $return['messages'][$type][$target] = $message;
                }
                else
                {
                    // if no target is specified,
                    // use the key to maintain consistent structure
                    $return['messages'][$key][$key] = $message;
                }
            }

            return $return;
        }
        else
            return null;
    }

}
