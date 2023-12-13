<nav class="navbar">
  <div class="nav-logo">
    <a href="/"><img src="{{ asset('assets/user/images/logo.png') }}" alt="logo"></a>
    <b>From : </b>
    <a href="#" class="location">
      @guest
        @if (Route::has('login'))
          <a href="{{ route('login') }}">Login</a>
        @endif
      @else
        {{ Auth::user()->city }}
      @endguest
    </a>
  </div>
  
  <div class="nav-search">
    <select class="select-search">
      <option>All</option>
      <option value="Packet">Daily Need</option>
      <option value="Service">Service</option>
      <option value="Ticket">Ticket</option>
      <option value="Package">Package</option>
      <option value="Course">Course</option>
    </select>
    <input type="text" placeholder="Search" class="search-input">
    <div class="search-icon">
      <span class="material-symbols-outlined">search</span>
    </div>
  </div>

  <div class="sign-in">
    @guest
      @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
      @endif

      @if (Route::has('register'))
        <li>
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
      @endif
    @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          <p>Hello, {{ Auth::user()->name }}</p>
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    @endguest
  </div>
</nav>
