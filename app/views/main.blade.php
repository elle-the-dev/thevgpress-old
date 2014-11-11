<!doctype html>
<html lang="en-US" dir="ltr">

<head>

    <title>{{ $title }} - The VG Press</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/screen.css') }}
    @if (isset($styles) && is_array($styles))
        @foreach ($styles as $style)
            {{ HTML::style($style) }}
        @endforeach
    @endif

    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/moment.min.js') }}
    {{ HTML::script('js/main.js') }}
    @if (isset($scripts) && is_array($scripts))
        @foreach ($scripts as $script)
            {{ HTML::script($script) }}
        @endforeach
    @endif

    <link rel="icon" href="{{ URL::to('/') }}/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ URL::to('/') }}/favicon.ico" type="image/x-icon" />

</head>

<body>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ URL::to('/') }}/img/logo.png" alt="The VG Press" /></a>
            </div>

            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ URL::to('/') }}">Home</a></li>
                    <li><a href="{{ URL::to('news') }}">News</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Forum <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::to('forum/gaming-discussion') }}">Gaming Discussion</a></li>
                            <li><a href="{{ URL::to('forum/non-gaming-discussion') }}">Non-Gaming Discussion</a></li>
                            <li><a href="{{ URL::to('forum/blogs') }}">Blogs</a></li>
                            <li><a href="{{ URL::to('forum/podcasts') }}">Podcasts</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ URL::to('news') }}">Reviews</a></li>
                    <li><a href="{{ URL::to('news') }}">Podcast</a></li>

                    @if ($loggedInUser = Auth::user())
                        <li><a href="{{ URL::to('news') }}">Profile</a></li>
                        <li><a href="{{ URL::to('chat') }}" class="chat">Chat</a></li>
                        <li><a href="{{ URL::to('logout') }}">Logout ({{ $loggedInUser->username }})</a></li>
                    @else
                        <li><a href="{{ URL::to('login') }}" class="login">Login</a></li>
                        <li><a href="{{ URL::to('join') }}" class="join">Join</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main id="content" class="container-fluid">
        <h1>{{ $heading }}</h1>
        <section id="alerts">
            @include ('reportBagMessages', array('messages' => Messaging::get('errors'), 'id' => 'errors', 'class' => 'danger'))
            @include ('reportBagMessages', array('messages' => Messaging::get('warnings'), 'id' => 'warnings', 'class' => 'warning'))
            @include ('reportBagMessages', array('messages' => Messaging::get('infos'), 'id' => 'infos', 'class' => 'info'))
            @include ('reportBagMessages', array('messages' => Messaging::get('successes'), 'id' => 'successes', 'class' => 'success'))
        </section>
        @if (isset($content))
            {{ $content }}
        @endif
    </main>

    @if (!$loggedInUser)
        @include ('loginModal')
    @endif
</body>

</html>
