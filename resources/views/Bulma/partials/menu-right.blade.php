{{-- <li class="hide-for-small-only">
    <a href="#" data-toggle-search-trigger>
        <i class="fas fa-search"></i>
    </a>
</li> --}}
@if (Auth::guest())
    <div class="buttons">
        <a href="{{ route('register') }}" class="button is-primary">
        <strong>Sign up</strong>
        </a>
        <a href="{{ route('login') }}" class="button is-light">
        Log in
        </a>
    </div>
@else
    <div class="buttons">
        <a href="{{ route('voyager-frontend.account') }}" class="button is-primary">
        <strong>Update Account</strong>
        </a>
        @if (Session::has('original_user.id'))
            <a href="#" class="button is-light"
                onclick="document.getElementById('impersonate-form').submit();return false;">
                Switch back to {{ Session::get('original_user.name') }}
            </a>
            <form id="impersonate-form"
                    action="{{ route('voyager-frontend.account.impersonate', Session::get('original_user.id')) }}"
                    method="POST"
                    style="display: none;">
                @csrf
            </form>
        @else
            <a href="#" class="button is-light" onclick="document.getElementById('logout-form').submit();return false;">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
@endif