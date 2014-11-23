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

    <link 
        rel="icon" 
        href="{{ URL::to('/') }}/favicon.ico" 
        type="image/x-icon"
    >
    <link
        rel="shortcut icon"
        href="{{ URL::to('/') }}/favicon.ico"
        type="image/x-icon"
    >

</head>

<body>

    @include ('nav')

    <main id="content" class="container-fluid">
        <h1>{{ $heading }}</h1>
        <section id="alerts">
            @include (
                'reportBagMessages',
                array(
                    'messages' => Messaging::get('errors'),
                    'id' => 'errors',
                    'class' => 'danger'
                )
            )
            @include (
                'reportBagMessages',
                array(
                    'messages' => Messaging::get('warnings'),
                    'id' => 'warnings',
                    'class' => 'warning'
                )
            )
            @include (
                'reportBagMessages',
                array(
                    'messages' => Messaging::get('infos'),
                    'id' => 'infos',
                    'class' => 'info'
                )
            )
            @include (
                'reportBagMessages',
                array(
                    'messages' => Messaging::get('successes'),
                    'id' => 'successes',
                    'class' => 'success'
                )
            )
        </section>
        @if (isset($content))
            {{ $content }}
        @endif
    </main>

    @if (!$loggedInUser)
        @include ('loginModal')
    @else
        <div id="chat-modal"></div>
    @endif
</body>

</html>
