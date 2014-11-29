<li class="conversation-{{ $id }}
    @if (
        in_array(
            $id, 
            array(
                $userIdSender,
                $userIdReceiver
            )
        )
    )
        selected
    @endif"
>
    <a href="
        {{ URL::to('chat') }}/{{ $username }}
    ">
        <img src=
            "{{ URL::to('/') }}/uploads/users/user_{{ $id }}/avatar"
            alt="[avatar]"
        >
        {{ $username }}
    </a>
</li>
