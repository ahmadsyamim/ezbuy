<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
            <img src="{{ url('/images/logo.png') }}" alt="{{ setting('site.title') }}" title="{{ setting('site.title') }}" />
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            {{ menu('primary', 'Bulma.partials.menu-left') }}
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                @include('Bulma.partials.menu-right')
            </div>
        </div>
    </div>
</nav>