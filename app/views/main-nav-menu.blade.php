<ul class="nav navbar-nav">
    <li class="active">
        <a href="{{ URL::to('/') }}">Home</a>
    </li>
    <li>
        <a href="{{ URL::to('news') }}">News</a>
    </li>
    <li class="dropdown">
        <a href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
        >
            Forum
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ URL::to('forum/gaming-discussion') }}">
                    Gaming Discussion
                </a>
            </li>
            <li>
                <a href="{{ URL::to('forum/non-gaming-discussion') }}">
                    Non-Gaming Discussion
                </a>
            </li>
            <li>
                <a href="{{ URL::to('forum/blogs') }}">
                    Blogs
                </a>
            </li>
            <li>
                <a href="{{ URL::to('forum/podcasts') }}">
                    Podcasts
                </a>
            </li>
        </ul>
    </li>
    <li><a href="{{ URL::to('news') }}">Reviews</a></li>
    <li><a href="{{ URL::to('news') }}">Podcast</a></li>

    @if ($loggedInUser = Auth::user())
        <li><a href="{{ URL::to('news') }}">Profile</a></li>
        <li>
            <a href="{{ URL::to('chat') }}" class="chat">
                Chat
            </a>
        </li>
        <li>
            <a href="{{ URL::to('logout') }}">
                Logout ({{ $loggedInUser->username }})
            </a>
        </li>
    @else
        <li>
            <a href="{{ URL::to('login') }}" class="login">
                Login
            </a>
        </li>
        <li>
            <a href="{{ URL::to('join') }}" class="join">
                Join
            </a>
        </li>
    @endif
</ul>
