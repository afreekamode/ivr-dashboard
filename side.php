<!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="dash.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fr fa-user"></i>
            <span></span><?php echo "<span style='color : yellow;' >Welcome $user </span>";?>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <hr>
           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="color: blue;">Logout</a>
            <a class="dropdown-item" href="login.php?logadmin" style="color: blue;">Signup</a>
            <a class="dropdown-item" href="signup.php?update">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <div class="card-footer small text-muted"></div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jobass.php?$user">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Assign a task</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="performance.php">
            <i class="fas fa-fw fa-table"></i>
            <span>All Assigned Task</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Performance Charts</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php?logad">
            <i class="fas fa-fw fa-table"></i>
            <span>Performance Tables</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="new_request.php">
            <i class="fas fa-fw fa-table"></i>
            <span>New Requests Table</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          