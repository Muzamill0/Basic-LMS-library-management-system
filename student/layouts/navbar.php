<nav>
      <div class="navbar">
        <div class="logo">
          <h1><?php echo $_SESSION['user']['name'] ?></h1>
        </div>
        <ul>
          <li><a href="../dashboard/dashboard.php">
            <i class="fas fa-user"></i>
            <span class="nav-item">Dashboard</span>
          </a>
          </li>
          <li><a href="../assign_book/">
            <i class="fas fa-book"></i>
            <span class="nav-item">Assigned Books</span>
          </a>
          </li>
          <li><a href="../profile/edit.php">
            <i class="fas fa-pencil-alt"></i>
            <span class="nav-item">Edit Profile</span>
          </a>
          </li>
          <li><a href="../../logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Logout</span>
          </a>
          </li>
        </ul>
      </div>
    </nav>