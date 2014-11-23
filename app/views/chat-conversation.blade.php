<li class="conversation-{{ $conversation->id }}
    @if (
        in_array(
            $conversation->id, 
            array(
                $lastMessage->user_id_sender,
                $lastMessage->user_id_receiver
            )
        )
    )
        selected
    @endif"
>
    <a href="
        {{ URL::to('chat') }}/{{$conversation->username }}
    ">
        <img src=
            "{{ URL::to('/') }}/uploads/users/user_{{ $conversation->id }}/avatar"
            alt="[avatar]"
        >
        {{ $conversation->username }}
    </a>
</li>
