<div class="comment-container">
    <div class="sidebar">
        <div class="username">
            <a href="{{ URL::to('profile/'.$comment->author->username) }}">
                {{ $comment->author->username }}
            </a>
        </div>
        <div class="avatar">
            <img 
                src="{{
                    URL::to('uploads/users/'.$comment->author->username)
                }}"
                alt="{{ $comment->author->username }}"
            >
        </div>
        <div class="score">
            <a href="{{ URL::to('leaderboard') }}">
                Rank: {{ $comment->author->rank() }}
                ({{ $comment->author->score }})
            </a>
        </div>
        <div class="country">
            Country:
        </div>
        <div class="commentCount">
            Comments: {{ $comment->author->commentCount() }}
        </div>
        <div class="newsCount">
            News Posts: {{ $comment->author->newsCount() }}
        </div>
        <div class="joined">
            Joined: {{ $comment->author->created_at }}
        </div>
    </div>

    <div class="content">
        <div class="topbar">
            <div class="votes">{{ $comment->votes() }}</div>
            <div class="created-at">{{ $comment->created_at }}</div>
        </div>

        <div class="comment">
            {{ $comment->comment }}
        </div>

        @if ($comment->updated_at != $comment->created_at)
            <div class="updated-at">
                Edited: {{ $comment->updated_at }}
            </div>
        @endif

        <div class="signature">
            {{ $comment->author->signature }}
        </div>
    </div>
</div>
