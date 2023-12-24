<nav class="navbar">
  <div class="nav-logo">
    <a href="#"><img src="{{ asset('assets/user/images/logo.png') }}" alt="logo"></a>
  </div>
  <div class="address">
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

  <div class="returns">
    <a href="#"><p>Returns</p>
      <span>&amp; Orders</span></a>
  </div>

  <div class="cart">
    <a href="#">
      <span class="material-symbols-outlined cart-icon">shopping_cart</span>
      </a>
      <p>Cart</p>
  </div>
</nav>

<div class="banner">
  <div class="banner-content">
    <div class="panel">
      <span class="material-symbols-outlined">menu</span>
      <a href="#">All</a>
    </div>

    <ul class="links">
<li><a href="#">Today's Deals</a></li>
<li><a href="#">Bus Tickets</a></li>
<li><a href="#">Tour Packages</a></li>
<li><a href="#">Courses</a></li>
<li><a href="#">Electronics</a></li>
<li><a href="#">Digital</a></li>
</ul>
<div class="deals">
<a href="#">Recycle Units</a>
</div>
  </div>
</div>