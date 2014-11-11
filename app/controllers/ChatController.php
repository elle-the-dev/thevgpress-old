<?php
class ChatController extends AuthController {

    public function __construct()
    {
        parent::__construct('TEST');
    }

    public function chat($username=null)
    {
        $loggedInUser = Auth::user();
        $lastMessage = Message::join('users', 'users.id', '=', 'user_id_sender')
            ->where('user_id_receiver', $loggedInUser->id)
            ->orWhere('user_id_sender', $loggedInUser->id)
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
            // autoload the conversation with the most recent received message for the user
            $messages = $this->getMessages($lastMessage->username);
            $log = DB::getQueryLog();
        }

        // no messages, set a default
        if (!isset($messages) || is_null($messages))
            $messages = array();

        // list of users with which the logged in user has conversations
        $senderConversations = DB::table('users')->select('users.id', 'username')
            ->join('messages', 'users.id', '=', 'messages.user_id_sender')
            ->where('user_id_receiver', $loggedInUser->id)
            ->groupBy('users.id')
            ->orderBy('messages.created_at', 'desc');

        $receiverConversations = DB::table('users')->select('users.id', 'username')
            ->join('messages', 'users.id', '=', 'messages.user_id_receiver')
            ->where('user_id_sender', $loggedInUser->id)
            ->groupBy('users.id')
            ->orderBy('messages.created_at', 'desc');

        $conversations = $senderConversations->union($receiverConversations)->get();

        $this->layout->title = "Chat";
        $this->layout->heading = "Chat";
        $this->layout->content = View::make("chat", array('messages' => $messages, 'conversations' => $conversations, 'lastMessage' => $lastMessage));
    }

    public function messages($username)
    {
        $loggedInUser = Auth::user();
        $messages = $this->getMessages($username);
        foreach ($messages as $message)
        {
            $class = $message->user_id_receiver == $loggedInUser->id ? 'receiver' : 'sender';
            echo '<li class="'.$class.'">';
            echo View::make('chat-message', array(
                      'userId' => $message->user_id_sender
                    , 'username' => $message->username
                    , 'message' => $message->message
                )
            );
            echo '</li>';
        }
    }

    private function getMessages($username)
    {
        $userId = Auth::user()->id;
        return Message::join(DB::raw('users sender'), 'sender.id', '=', 'user_id_sender')
            ->join(DB::raw('users receiver'), 'receiver.id', '=', 'user_id_receiver')
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
