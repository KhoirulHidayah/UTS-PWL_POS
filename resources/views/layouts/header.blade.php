<style>
  /* Navbar background gradient */
  .navbar {
      background: linear-gradient(45deg, #007BFF, #00C6FF);
      border-bottom: 2px solid #0056b3;
  }

  /* Style for PWL_POS */
  .nav-title-box {
      background-color: #eaf0f7d5; /* Warna abu-abu */
      color: #8babcade; /* Warna teks */
      padding: 5px 15px; /* Padding */
      border-radius: 5px; /* Sudut melengkung */
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan */
      margin-left: 15px; /* Margin kiri */
      display: inline-block; /* Menjadikan elemen sebagai kotak */
  }

  .navbar-nav .nav-item .nav-link.box {
      background-color: #fff;
      color: #007BFF;
      padding: 5px 15px;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s, color 0.3s;
  }

  .navbar-nav .nav-item .nav-link.box:hover {
      background-color: #007BFF;
      color: #fff;
  }

  /* Dropdown menu styling */
  .dropdown-menu {
      background: #f0f8ff;
      border: 1px solid #007BFF;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
  }

  .dropdown-item:hover {
      background-color: #007BFF;
      color: #fff;
  }

  .dropdown-item i {
      color: #007BFF;
  }

  .dropdown-item:hover i {
      color: #fff;
  }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <div class="nav-title-box">PWL_POS</div> <!-- Tambahkan kotak disini -->
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Profile Update Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            @if(auth()->user()->avatar)
                <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="30" height="30">
            @else
                <i class="fas fa-user"></i>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ url('profile/update') }}" class="dropdown-item">
                <i class="fas fa-user-edit mr-2"></i> Update Foto Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ url('user_profile/updatedatadiri') }}" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> Update Data Diri
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ url('password/update') }}" class="dropdown-item">
                <i class="fas fa-lock mr-2"></i> Update Password
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
  </ul>

</nav>
