<?php
class ChatController extends PageController {

    /**
     * Display the chat window
     *
     * @param string    $username
     * @return View
     */
    public function chat($username=null)
    {
        // most recent message sent or received by the logged in user
        $lastMessage = Message::join('users', 'users.id', '=', 'user_id_sender')
            ->where('user_id_receiver', $this->user->id)
            ->orWhere('user_id_sender', $this->user->id)
            ->orderBy('messages.created_at', 'desc')
            ->take(1)
            ->first();

        if ($username)
        {
            // messages for a specific user
            $messages = $this->getMessages($username);
        }
        else if (isset($lastMessage) && !is_null($lastMessage))
        {
            // autoload the conversation with the most recent 
            // received message for the user
            $messages = $this->getMessages($lastMessage->username);
        }

        // no messages, set a default
        if (!isset($messages) || is_null($messages))
            $messages = array();

        $conversations = $this->user->conversations();

        $view = View::make(
            "chat",
            array(
                'messages' => $messages,
                'conversations' => $conversations,
                'lastMessage' => $lastMessage
            )
        );

        // AJAX load means chat in a modal, so don't use a layout
        if (Request::ajax())
            return $view;
        else
        {
            $this->layout->title = "Chat";
            $this->layout->heading = "Chat";
            $this->layout->content = $view;
        }
    }

    /**
     * Display chat messages
     *
     * @param string    $username
     * @return View
     */
    public function messages($username)
    {
        $this->layout = null;
        $messages = $this->getMessages($username);
        foreach ($messages as $message)
        {
            $class = $message->user_id_receiver == $this->user->id
                ? 'receiver'
                : 'sender';

            return '<li class="'.$class.'">'
                .View::make(
                    'chat-message',
                    array(
                        'userId' => $message->user_id_sender,
                        'username' => $message->username,
                        'message' => $message->message
                    )
                )
                .'</li>';
        }
    }

    /**
     * Get all messages for a given user
     *
     * @param string    $username
     * @return array
     */
    private function getMessages($username)
    {
        $userId = $this->user->id;
        return Message::join(
                DB::raw('users sender'),
                'sender.id',
                '=',
                'user_id_sender'
            )
            ->join(
                DB::raw('users receiver'),
                'receiver.id',
                '=',
                'user_id_receiver'
            )
            ->where(function ($where) use ($userId)
            {
                $where->where('user_id_receiver', $userId)
                    ->orWhere('user_id_sender', $userId);
            })
            ->where(function ($where) use ($username)
            {
                $where->where('sender.username', $username)
                    ->orWhere('receiver.username', $username);
            })
            ->get();
    }

}
