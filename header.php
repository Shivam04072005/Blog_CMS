
<?php session_start()?>
<style>
  header {
    background: #4CAF50;
    color: white;
    padding: 15px 22px;
    position: relative;
    text-align: left;
  }

  header table {
    width: 100%;
  }

  header h1 {
    margin: 0;
    font-size: 22px;
  }

  header p {
    margin: 3px 0 0;
    font-size: 14px;
  }

  .menu-bar {
    display: flex;
    flex-direction: row-reverse;
    padding: 2px;
  }

  .menu-bar button {
    margin-right: 10px;
  }

  button {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 16px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.12);
    transition: background 0.2s;
  }

  button a {
    text-decoration: none;
    color: white;
  }

  button:hover {
    background: #388E3C;
  }

  .mobile-menu-btn {
    font-size: 28px;
    cursor: pointer;
    padding: 6px 12px;
    display: none;
    color: white;
    position: absolute;
    right: 12px;
    top: 10px;
    z-index: 1000;
  }
</style>
<header>
  <table>
    <tr>
      <td>
        <a href="index.php" style="color:white; text-decoration:none">
          <h1>WriteIt</h1>
        </a>
        <p style="color:white; text-decoration:none">Just Write It</p>
        <span class="mobile-menu-btn" onclick="toggleSidebar()">&#9776;</span>
      </td>
      <td>
        <div class="menu-bar">
          <?php if(isset($_SESSION['logged_in']) && $_SESSION["logged_in"]===true){
            echo '<button>Welcome, ',$_SESSION['username'],'</buton>';
            echo '<button><a href="logout.php">Logout</a></buton>';
          }
          else{
            echo '<button><a href="loginpage.php">Login</a></buton>';
          }
          echo '<button><a href="#">Contact Us</a></buton>';
            echo '<button><a href="#">About Us</a></buton>';
            echo '<button><a href="#">Authors</a></buton>';
            echo '<button><a href="#">Audio</a></buton>';
            echo '<button><a href="index.php">Home</a></buton>';
            ?>
        </div>
      </td>
    </tr>
  </table>
</header>