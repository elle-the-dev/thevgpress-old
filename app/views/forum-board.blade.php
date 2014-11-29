<table class="table">

    <tr>
        <th>Votes</th>
        <th>Topics</th>
        <th>Replies</th>
        <th>Unread</th>
        <th>Author</th>
        <th>Last Post</th>
    </tr>

    @foreach ($topics as $topic)

        <tr>
            <td>{{{ $topic->votes }}}</td>
            <td>
                <a href="{{ URL::to('forum-topics/'.$topic->slug) }}">
                    {{{ $topic->title }}}
                </a>
            </td>
            <td>{{{ $topic->replies() }}}</td>
            <td>{{{ $topic->unread()->count() }}}</td>
            <td>{{{ $topic->author->username }}}</td>
            <td>{{{ $topic->lastPost() }}}</td>
        </tr>

    @endforeach

</table>
