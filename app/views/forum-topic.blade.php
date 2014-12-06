<section id="comments">
@foreach ($topic->comments as $comment)

    <div>
        <div>{{ $comment->author->username }}</div>
        <div>Country: </div>
        <div>Comments: {{ $comment->author->commentCount() }}</div>
        <div>News Posts: {{ $comment->author->newsCount() }}</div>
        <div>Joined: {{ $comment->author->created_at }}</div>
    </div>

    <div>
        <div>
            <div>{{ $comment->created_at }}</div>
            <div>{{ $comment->votes() }}</div>
        </div>

        <div>
            {{ $comment->comment }}
        </div>

        <div>
            {{ $comment->updated_at }}
        </div>
    </div>

@endforeach
</section>
