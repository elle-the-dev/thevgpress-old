<table class="table">

    <tr>
        <th>Votes</th>
        <th>Topics</th>
        <th>Replies</th>
        <th>Unread</th>
        <th>Author</th>
        <th>Last Post</th>
    </tr>

    @foreach ($board->topics as $topic)

        <tr>
            <td class="votes">{{{ $topic->votes() }}}</td>
            <td>
                <a href="{{ URL::to('forum/'.$board->slug.'/'.$topic->slug) }}">
                    {{{ $topic->title }}}
                </a>
            </td>
            <td>{{{ $topic->comments()->count()-1 }}}</td>
            <td>{{{ $topic->unread()->count() }}}</td>
            <td>
                <a href="{{ URL::to('users/'.$topic->author->username) }}">
                    {{{ $topic->author->username }}}
                </a>
            </td>
            <td>{{{ $topic->lastComment()->created_at }}}</td>
        </tr>

    @endforeach

</table>
