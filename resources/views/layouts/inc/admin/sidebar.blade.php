
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ '/admin/dashboard' }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Product</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ '/items/create' }}" target="_blank">Add Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/items' }}" target="_blank">Product list</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/stocks' }}" target="_blank">Stock List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/stocks/add' }}" target="_blank">Add Stock</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/stocks/transfer' }}" target="_blank">Stock Transfer</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/stocks/bill' }}" target="_blank">Bill Genreation</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Reffered</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ 'ref/commission' }}" target="_blank">Commission</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ '/ref' }}" target="_blank">Refferals</a></li>
            
          </ul>
        </div>      
          
      <li class="nav-item">
        <a class="nav-link" href="pages/charts/chartjs.html">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title"><a class="nav-link" href="{{ 'ref/pools' }}" target="_blank">Reward Points</a></span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/tables/basic-table.html">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Admin</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Admin</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="auth\register"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> List </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Edit / Delete </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Cash Counter</span>
        </a>
      </li>
    </ul>
  </nav>