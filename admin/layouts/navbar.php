<nav>
      <div class="navbar">
        <div class="logo">
          <h1><?php echo $_SESSION['user']['name'] ?></h1>
        </div>
        <ul>
          <li><a href="../dashboard/dashboard.php">
            <i class="fas fa-th"></i>
            <span class="nav-item">Dashboard</span>
          </a>
          </li>
          <li><a href="../books/">
            <i class="fas fa-book"></i>
            <span class="nav-item">Books</span>
          </a>
          </li>
          <li><a href="../students/">
            <i class="fas fa-users"></i>
            <span class="nav-item">Students</span>
          </a>
          </li>
          <li><a href="../assign_book/">
            <i class="fab fa-dochub"></i>
            <span class="nav-item">Assigned Books</span>
          </a>
          </li>
          <li><a href="../profile/edit.php">
          <i class="fas fa-pencil-alt"></i>
            <span class="nav-item">Profile Update</span>
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