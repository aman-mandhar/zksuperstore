
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link normal-navigation" href="{{ '/admin/dashboard' }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ '/sales/newrefsale' }}"  class="nav-link normal-navigation">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <h5>New Sale</h5>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#auth">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> All Products </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> All Categories </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> Requirement of any <br>else Product </a></li>
          </ul>
      </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Services</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> All Services </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> All Categories </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> Requirement of any <br>else Service </a></li>
            </ul>
        </div>
      </li>

    <li class="nav-item">
      <a class="nav-link" href="#auth">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Reward Points</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link normal-navigation" href="auth\register"> Referral Points </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> Customer Points </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Business Points </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Adjust </a></li>
          </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Referrals</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link normal-navigation" href="auth\register"> Add Referral </a></li>
              <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> List of Referrals </a></li>
          </ul>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">My Account</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="auth\register"> Profile </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/register.html"> Orders </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Wishlist </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Cart </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Addresses </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Payment Methods </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="pages/samples/lock-screen.html"> Logout </a></li>
            </ul>
        </div>
      </li>
  </ul>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
      $(document).ready(function () {
  $('.nav-link.normal-navigation').on('click', function () {
      // Continue with normal navigation for links with the class 'normal-navigation'
      return;
  });

  $('.nav-link').not('.normal-navigation').on('click', function (e) {
      // Prevent the default behavior of the link for other links
      e.preventDefault();

      // Toggle the collapse state of the submenu with sliding animation
      $(this).next('.collapse').slideToggle();
      // Toggle the arrow icon class
      $(this).find('.menu-arrow').toggleClass('menu-arrow-reverse');
  });
});


  </script>
  </nav>