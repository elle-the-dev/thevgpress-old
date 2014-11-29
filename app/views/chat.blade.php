<section id="chat-container">
{{ Form::open(array('url' => '', 'class' => 'messages-container')) }}

    <div id="chat-sidebar">
        <section id="friends">
            <h3>Conversations</h3>
            <ul>
                @foreach ($conversations as $conversation)
                    @include (
                        'chat-conversation',
                        array(
                            'id' => $conversation->id,
                            'username' => $conversation->username,
                            'userIdSender' => $lastMessage->user_id_sender,
                            'userIdReceiver' => $lastMessage->user_id_receiver
                        )
                    )
                @endforeach
            </ul>
        </section>

        <section id="channels">
            <h3>Channels</h3>
            <ul>
                <li><a href="#">Gaming Discussion</a></li>
            </ul>
        </section>
    </div>

    <div id="messages">
        <ul>
            @foreach ($messages as $message)
                <li class="{{
                        $message->user_id_sender == Auth::user()->id
                            ? 'sender'
                            : 'receiver'
                    }}"
                >
                @include (
                    'chat-message',
                    array(
                        'userId' => $message->user_id_sender,
                        'username' => $message->username,
                        'message' => $message->message,
                        'date' => $message->created_at,
                    )
                )
                </li>
            @endforeach
        </ul>
    </div>

    {{
        Form::textarea(
            'messages',
            '',
            array(
                'placeholder' => 'type your message here',
                'id' => 'message'
            )
        )
    }}
    {{
        Form::submit(
            'send',
            array(
                'id' => 'send',
                'class' => 'btn btn-primary'
            )
        )
    }}
    {{
        Form::hidden(
            'receiver-id',
            $conversations ? $conversations[0]->id : '',
            array(
                'placeholder' => 'receiver',
                'id' => 'receiver-id'
            )
        )
    }}

{{ Form::close() }}
</section>

<div style="display: none" id="empty-message">
    @include ('chat-message', array(
            'userId' => '',
            'username' => '',
            'message' => '',
            'date' => ''
        )
    )
</div>


<script>
var socket = io.connect('{{ URL::to('/') }}:3000');

$('form').submit(function()
{
    socket.emit(
        'message',
        {
            message: $('#message').val(),
            receiverId: $('#receiver-id').val(),
            session: '{{ Session::getId() }}'
        }
    );

    appendMessage(
        'sender',
        {{ $loggedInUser->id }},
        '{{ $loggedInUser->username }}',
        $('#message').val()
    );

    $('#message').val('');
    return false;
});

socket.on('connect', function () {
    socket.emit('joinChat', { session: '{{ Session::getId() }}' } );
});

socket.on('message', function(msg)
{
    if ($('.conversation-'+msg.userId).length > 0)
    {

    }
    else
    {
    }
    appendMessage('receiver', msg.userId, msg.username, msg.message);
});

function appendMessage(className, senderId, senderUsername, messageText)
{
    var message = $('#empty-message');
    message.find('.message').html(messageText);
    message.find('img').attr(
        'src',
        '{{ URL::to("/") }}/uploads/user_'+senderId+'/avatar'
    ).attr(
        'alt',
        senderUsername
    );
    message.find('.date').html(moment().format('YYYY-MM-DD HH:mm:ss'));
    $('#messages ul').append(
        '<li class="'+className+'">'+message.html()+'</li>'
    );
}
</script>
