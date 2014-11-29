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

    @include ('main-nav')

    <main id="content" class="container-fluid">

        <h1>{{ $heading }}</h1>

        <section id="alerts">
            @foreach (array(
                'errors' => 'danger',
                'warnings' => 'warning',
                'infos' => 'info',
                'successes' => 'success'
            ) as $type => $class)

            @include (
                'reportBagMessages',
                array(
                    'messages' => Messaging::get($type),
                    'id' => $type,
                    'class' => $class
                )
            )

            @endforeach
        </section>

        @if (isset($content))
            {{ $content }}
        @endif

        @if (!Auth::user())
            @include ('loginModal')
        @else

<script src="{{ URL::to('/') }}:3000/socket.io/socket.io.js"></script>
<section id="chat-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <header class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Chat</h4>
            </header>
            <div class="modal-body">
            </div>

            <div id="chat-window-footer" class="modal-footer">
            </div>
        </div>
    </div>
</section>
        @endif

    </main>

</body>

</html>
