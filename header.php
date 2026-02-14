<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  header {
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    position: relative;
  }

  header h1 {
    margin: 0;
    font-size: 24px;
  }

  header p {
    font-size: 14px;
    opacity: 0.9;
  }

  .nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  /* MENU BUTTONS */
  .menu-bar {
    display: flex;
    gap: 12px;
  }

  .menu-btn {
    padding: 10px 18px;
    background: white;
    color: #4CAF50;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    transition: 0.2s;
  }

  .menu-btn:hover {
    background: #e6e6e6;
  }

  .menu-btn a {
    text-decoration: none;
    color: inherit;
  }

  /* MOBILE MENU BUTTON */
  .mobile-menu-btn {
    font-size: 28px;
    cursor: pointer;
    display: none;
    color: white;
  }

  /* SIDEBAR FOR MOBILE */
  .sidebar {
    position: fixed;
    top: 0;
    right: -260px;
    width: 260px;
    height: 100%;
    background: #4CAF50;
    padding: 30px 20px;
    transition: 0.3s;
    z-index: 2000;
  }

  .sidebar.open {
    right: 0;
  }

  .sidebar button {
    display: block;
    width: 100%;
    margin: 12px 0;
  }

  /* RESPONSIVE */
  @media (max-width: 820px) {
    .menu-bar {
      display: none;
    }
    .mobile-menu-btn {
      display: block;
    }
  }
</style>
</head>
<body>
<?php session_start(); ?>

<header>
  <div class="nav-container">
    <div>
      <a href="index.php" style="text-decoration:none; color:white;">
        <h1>WriteIt</h1>
      </a>
      <p>Just Write It</p>
    </div>

    <span class="mobile-menu-btn" onclick="toggleSidebar()">&#9776;</span>

    <div class="menu-bar">
      <?php
        if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] === true) {
          echo '<button class="menu-btn"><a href="logout.php">Logout</a></button>';
          echo '<button class="menu-btn">Welcome, '.$_SESSION['username'].'</button>';
        } else {
          echo '<button class="menu-btn"><a href="loginpage.php">Login</a></button>';
        }
      ?>
    </div>
  </div>
</header>

<!-- MOBILE SIDEBAR -->
<div id="sidebar" class="sidebar">
  <?php
    if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] === true) {
      echo '<button class="menu-btn">Welcome, '.$_SESSION['username'].'</button>';
      echo '<button class="menu-btn"><a href="logout.php">Logout</a></button>';
    } else {
      echo '<button class="menu-btn"><a href="loginpage.php">Login</a></button>';
    }
    echo '<button class="menu-btn"><a href="#">Contact Us</a></button>';
    echo '<button class="menu-btn"><a href="#">About Us</a></button>';
    echo '<button class="menu-btn"><a href="#">Authors</a></button>';
    echo '<button class="menu-btn"><a href="#">Audio</a></button>';
    echo '<button class="menu-btn"><a href="index.php">Home</a></button>';
  ?>
</div>

<script>
function toggleSidebar() {
  document.getElementById('sidebar').classList.toggle('open');
}
</script>
