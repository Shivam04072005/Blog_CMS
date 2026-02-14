<?php
include_once("connection.php");

$posts = [];

try {

  $stmt = $conn->prepare("
        SELECT id, title, author, category, date_created, content 
        FROM posts 
        ORDER BY id DESC
    ");

  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  die("Error fetching posts: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>WriteIt</title>

  <style>
    /* ---------------- GLOBAL ---------------- */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f8f8f8;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ---------------- HEADER ---------------- */
    header {
      background: #4CAF50;
      color: white;
      padding: 15px 22px;
      position: relative;
      text-align: left;
    }

    header h1 {
      margin: 0;
      font-size: 22px;
    }

    header p {
      margin: 3px 0 0;
      font-size: 14px;
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

    /* ---------------- CONTAINER ---------------- */
    .container {
      display: flex;
      max-width: 1100px;
      margin: 18px auto;
      width: 100%;
      padding: 0 16px;
      gap: 16px;
      flex: 1;
    }

    main {
      flex: 3;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ---------------- POST CARD ---------------- */
    .post {
      background: white;
      padding: 22px;
      margin: 12px 0;
      width: 750px;
      max-width: 100%;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
      transition: transform .15s ease, box-shadow .15s ease;
    }

    .post:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .post h2 {
      margin: 0 0 6px;
      font-size: 24px;
    }

    .meta {
      color: #777;
      font-size: 0.92rem;
      margin-bottom: 12px;
    }

    .post p {
      color: #333;
      line-height: 1.55;
    }

    button.read-more {
      margin-top: 8px;
      background: #4CAF50;
      color: white;
      border: none;
      padding: 9px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.12);
      transition: 0.2s ease;
    }

    button.read-more:hover {
      background: #388E3C;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    /* ---------------- DESKTOP SIDEBAR ---------------- */
    .sidebar-card {
      flex: 1;
      background: #fff;
      padding: 22px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
      position: sticky;
      top: 90px;
      height: fit-content;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .sidebar-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .sidebar-card h3 {
      margin-top: 0;
      font-size: 18px;
      font-weight: 600;
      background: linear-gradient(120deg, #4CAF50, #66BB6A);
      color: white;
      padding: 10px 15px;
      border-radius: 10px;
      margin-bottom: 16px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .sidebar-card ul {
      list-style: none;
      padding: 0;
      margin: 0 0 20px;
    }

    .sidebar-card li {
      margin-bottom: 12px;
    }

    .sidebar-card a {
      text-decoration: none;
      color: #333;
      font-size: 15px;
      padding: 6px 10px;
      display: block;
      border-radius: 8px;
      transition: 0.2s ease;
    }

    .sidebar-card a:hover {
      background: #E8F5E9;
      color: #388E3C;
      padding-left: 14px;
      font-weight: 500;
    }

    /* Divider for sections */
    .sidebar-card ul+h3 {
      margin-top: 24px;
      padding-top: 10px;
      border-top: 1px solid #e0e0e0;
    }

    /* ---------------- MOBILE SIDEBAR ---------------- */
    .mobile-sidebar {
      height: 100%;
      width: 280px;
      position: fixed;
      top: 0;
      right: -280px;
      z-index: 3000;
      background: #fff;
      padding: 22px;
      border-radius: 16px 0 0 16px;
      transition: right 0.3s ease, box-shadow 0.3s ease;
      color: #333;
      overflow-y: auto;
      box-shadow: -4px 0 30px rgba(0, 0, 0, 0.2);
    }

    .mobile-sidebar.open {
      right: 0;
    }

    .mobile-sidebar h3 {
      margin-top: 0;
      font-size: 16px;
      font-weight: 600;
      background: linear-gradient(120deg, #4CAF50, #66BB6A);
      color: white;
      padding: 10px 15px;
      border-radius: 10px;
      margin-bottom: 16px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .mobile-sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0 0 20px;
    }

    .mobile-sidebar li {
      margin-bottom: 12px;
    }

    .mobile-sidebar a {
      text-decoration: none;
      color: #333;
      font-size: 15px;
      padding: 6px 10px;
      display: block;
      border-radius: 8px;
      transition: 0.2s ease;
    }

    .mobile-sidebar a:hover {
      background: #E8F5E9;
      color: #388E3C;
      padding-left: 14px;
      font-weight: 500;
    }

    /* ---------------- ADD POST BUTTON ---------------- */
    .add-post-link {
      position: fixed;
      bottom: 70px;
      right: 24px;
      background: linear-gradient(135deg, #4CAF50, #388E3C);
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      text-align: center;
      line-height: 60px;
      font-size: 34px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.28);
      z-index: 1200;
    }

    /* ---------------- FOOTER ---------------- */
    footer {
      background: #4CAF50;
      color: white;
      text-align: center;
      padding: 12px;
      width: 100%;
    }

    /* ---------------- RESPONSIVE ---------------- */
    @media (max-width: 820px) {
      .mobile-menu-btn {
        display: block;
      }

      .sidebar-card {
        display: none;
      }

      .container {
        flex-direction: column;
      }

      .post {
        width: 100%;
        padding: 18px;
      }
    }

    @media (max-width: 420px) {
      .post {
        padding: 16px;
      }

      .post h2 {
        font-size: 19px;
      }

      .meta {
        font-size: 0.85rem;
      }

      button.read-more {
        padding: 7px 12px;
      }

      .add-post-link {
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 26px;
      }
    }
  </style>
</head>

<body>

  <?php include "header.php"; ?>

  <!-- MOBILE SIDEBAR -->
  <div id="mobileSidebar" class="mobile-sidebar">
    <span class="close-btn" onclick="toggleSidebar()">&times;</span>

    <h3>Categories</h3>
    <ul>
      <li><a href="#">General</a></li>
      <li><a href="#">Web Development</a></li>
      <li><a href="#">JavaScript</a></li>
      <li><a href="#">Lifestyle</a></li>
      <li><a href="#">Personal</a></li>
    </ul>

    <h3>Recent Posts</h3>
    <ul>
      <?php foreach ($posts as $p): ?>
        <li><a href="post.php?id=<?= $p['id']; ?>"><?= htmlspecialchars($p['title']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- MAIN PAGE -->
  <div class="container">

    <main>
      <?php if (count($posts) === 0): ?>
        <p>No posts yet. Create one!</p>
      <?php endif; ?>

      <?php foreach ($posts as $post): ?>
        <article class="post">
          <h2><?= htmlspecialchars($post['title']); ?></h2>
          <div class="meta">
            By <?= htmlspecialchars($post['author']); ?> ·
            <?= htmlspecialchars($post['date_created']); ?> ·
            <span style="color:#4CAF50; font-weight:600;"><?= htmlspecialchars($post['category']); ?></span>
          </div>
          <p><?= htmlspecialchars(substr($post['content'], 0, 200)); ?>...</p>
          <button class="read-more" onclick="location.href='post.php?id=<?= $post['id']; ?>'">Read More</button>
        </article>
      <?php endforeach; ?>
    </main>

    <!-- DESKTOP SIDEBAR -->
    <aside class="sidebar-card">
      <h3>Categories</h3>
      <ul>
        <li><a href="#">General</a></li>
        <li><a href="#">Web Development</a></li>
        <li><a href="#">JavaScript</a></li>
        <li><a href="#">Lifestyle</a></li>
        <li><a href="#">Personal</a></li>
      </ul>

      <h3>Recent Posts</h3>
      <ul>
        <?php foreach ($posts as $p): ?>
          <li><a href="post.php?id=<?= $p['id']; ?>"><?= htmlspecialchars($p['title']); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </aside>

  </div>

  <a href="create_post.php" class="add-post-link">+</a>

  <footer>&copy; 2025 WriteIt. All rights reserved.</footer>

  <script>
    function toggleSidebar() {
      document.getElementById('mobileSidebar').classList.toggle('open');
    }
  </script>

</body>

</html>