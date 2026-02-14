<?php
include_once("connection.php");

try {

    // Get unique string ID from URL
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($id == '') {
        die("Invalid post ID.");
    }

    // Fetch selected post using VARCHAR id
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        die("Post not found.");
    }

    // Fetch recent posts
    $recentStmt = $conn->prepare("
        SELECT id, title, author 
        FROM posts 
        ORDER BY date_created DESC 
        LIMIT 6
    ");
    $recentStmt->execute();
    $recentPosts = $recentStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error loading post.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?= htmlspecialchars($post['title']) ?></title>

<style>
/* --- Base & layout --- */
* { box-sizing: border-box; }
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background: #f8f8f8;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
header {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  position: relative;
}
header h1 { margin: 0; font-size: 20px; }
header p { margin: 4px 0 0; font-size: 13px; }

.mobile-menu-btn {
  font-size: 26px;
  cursor: pointer;
  padding: 8px 12px;
  display: none;
  color: white;
  position: absolute;
  right: 12px;
  top: 10px;
  z-index: 1100;
}

.mobile-sidebar {
  height: 100%;
  width: 260px;
  position: fixed;
  top: 0;
  right: -260px;
  z-index: 3000;
  background: #4CAF50;
  padding-top: 60px;
  transition: right 0.28s ease;
  color: white;
}
.mobile-sidebar.open { right: 0; }

.container {
  display: flex;
  max-width: 1100px;
  margin: 14px auto;
  padding: 0 14px;
  gap: 14px;
  width: 100%;
  flex: 1;
}

main { flex: 3; display: flex; justify-content: center; }

.sidebar {
  flex: 1;
  background: white;
  padding: 12px;
  border-radius: 8px;
  box-shadow: 0 0 6px rgba(0,0,0,0.08);
}

.post-full {
  background: white;
  padding: 22px;
  margin: 8px auto;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
  width: 750px;
  max-width: 100%;
  line-height: 1.6;
}

.post-full h2 { margin-top: 0; font-size: 26px; }

.meta {
  color: #777;
  font-size: 0.95rem;
  margin: 8px 0 14px;
}

.post-full p {
  white-space: pre-wrap;
  word-break: break-word;
}

.back-btn {
  display: inline-block;
  margin-top: 14px;
  padding: 9px 14px;
  background: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 6px;
}

footer {
  background: #4CAF50;
  color: white;
  text-align: center;
  padding: 10px;
  margin-top: 18px;
}

@media (max-width: 820px) {
  .container { flex-direction: column; }
  .sidebar { display: none; }
  .post-full { width: 100%; }
}
</style>
</head>
<body>

<?php include "header.php"; ?>

<!-- MOBILE SIDEBAR -->
<div id="mobileSidebar" class="mobile-sidebar">
  <h3 style="padding-left:20px;">Recent Posts</h3>
  <ul style="list-style:none; padding-left:20px;">
    <?php foreach ($recentPosts as $rp): ?>
      <li>
        <a style="color:white;text-decoration:none;"
           href="post.php?id=<?= $rp['id'] ?>">
           <?= htmlspecialchars($rp['title']) ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="container">

  <main>
    <article class="post-full">
      <h2><?= htmlspecialchars($post['title']) ?></h2>

      <div class="meta">
        By 
        <a style="color:#4CAF50;font-weight:600;"
           href="author_page.php?username=<?= htmlspecialchars($post['author']); ?>">
           <?= htmlspecialchars($post['author']); ?>
        </a>
        on <?= htmlspecialchars($post['date_created']); ?>
        <?php if (!empty($post['category'])): ?>
          · <span style="color:#4CAF50;font-weight:600;">
            <?= htmlspecialchars($post['category']) ?>
          </span>
        <?php endif; ?>
      </div>

      <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

      <a href="index.php" class="back-btn">⬅ Back</a>
    </article>
  </main>

  <!-- DESKTOP SIDEBAR -->
  <aside class="sidebar">
    <h3>Recent Posts</h3>
    <ul style="list-style:none;padding:0;">
      <?php foreach ($recentPosts as $rp): ?>
        <li>
          <a style="color:#4CAF50;text-decoration:none;"
             href="post.php?id=<?= $rp['id'] ?>">
             <?= htmlspecialchars($rp['title']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </aside>

</div>

<footer>&copy; 2025 WriteIt. All rights reserved.</footer>

</body>
</html>
