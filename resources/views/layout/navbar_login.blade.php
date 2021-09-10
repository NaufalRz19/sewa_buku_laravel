<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left side of navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right side of navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication links -->
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" id="navbarDropdown"
                                data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                        onClick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>
</nav>
