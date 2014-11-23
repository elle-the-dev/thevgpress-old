<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button 
                type="button"
                class="navbar-toggle collapsed"
                data-toggle="collapse"
                data-target="#main-navigation"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a
                class="navbar-brand"
                href="{{ URL::to('/') }}"
            >
                <img
                    src="{{ URL::to('/') }}/img/logo.png"
                    alt="The VG Press"
                >
            </a>
        </div>

        <div class="collapse navbar-collapse" id="main-navigation">
            @include ('main-nav-menu')
        </div>
    </div>
</nav>
