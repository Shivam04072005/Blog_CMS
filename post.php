<?php
// post.php
$host = "localhost";
$dbname = "blog_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Fetch selected post
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        http_response_code(404);
        echo "Post not found.";
        exit;
    }

    // Fetch recent posts for sidebar
    $recentStmt = $conn->prepare("SELECT id, title ,author FROM posts ORDER BY id DESC LIMIT 6");
    $recentStmt->execute();
    $recentPosts = $recentStmt->fetchAll(PDO::FETCH_ASSOC);
$author=$post['author'];
} catch (Exception $e) {
    http_response_code(500);
    echo "Error loading post.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?= htmlspecialchars($post['title']) ?></title>

<style>
  #author_link{
    color:#4CAF50;
    font-weight:600;
  }
/* --- Base & layout --- */
* { box-sizing: border-box; }
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background: #f8f8f8;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  -webkit-font-smoothing:antialiased;
}
header {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  position: relative;
}
header h1 { margin: 0; font-size: 20px; text-align: left; }
header p { margin: 4px 0 0; font-size: 13px; text-align: left; color: #eaf6ea; }

/* hamburger button (right) */
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

/* mobile sidebar (slides from right) */
.mobile-sidebar {
  height: 100%;
  width: 260px;
  position: fixed;
  top: 0;
  right: -260px;
  z-index: 3000;
  background: #4CAF50;
  overflow-x: hidden;
  padding-top: 60px;
  transition: right 0.28s ease;
  color: white;
  box-shadow: -2px 0 6px rgba(0,0,0,0.25);
}
.mobile-sidebar.open { right: 0; }
.mobile-sidebar h3 { padding-left: 20px; margin: 0 0 8px; }
.mobile-sidebar ul { list-style: none; padding-left: 18px; margin: 0 0 18px 0; }
.mobile-sidebar ul li { margin-bottom: 8px; }
.mobile-sidebar ul li a { color: white; text-decoration: none; display:block; padding:4px 0; }

/* page container */
.container {
  display: flex;
  max-width: 1100px;
  margin: 14px auto;
  padding: 0 14px;
  gap: 14px;
  width: 100%;
  flex: 1;
}
main {
  flex: 3;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 6px 0;
}
.sidebar {
  flex: 1;
  min-width: 220px;
  background: white;
  padding: 12px;
  border-radius: 8px;
  box-shadow: 0 0 6px rgba(0,0,0,0.08);
  height: fit-content;
}

/* --- POST CARD (responsive) --- */
.post-full {
  background: white;
  padding: 22px;
  margin: 8px auto;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
  width: 750px;
  max-width: 100%;
  line-height: 1.6;
  word-wrap: break-word;
  overflow-wrap: break-word;
}
.post-full h2 {
  margin-top: 0;
  font-size: 26px;
  color: #222;
  word-break: break-word;
}
.meta {
  color: #777;
  font-size: 0.95rem;
  margin: 8px 0 14px;
}

/* make long text wrap and prevent horizontal overflow */
.post-full p {
  white-space: pre-wrap;
  word-break: break-word;
  overflow-wrap: break-word;
  margin: 0 0 8px;
  font-size: 1rem;
  color: #333;
}

/* back button */
.back-btn {
  display: inline-block;
  margin-top: 14px;
  padding: 9px 14px;
  background: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.12);
  font-weight: 600;
}

/* read-more style for consistency (if used) */
button.read-more {
  background: #4CAF50;
  color: white;
  border: none;
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
}

/* footer */
footer {
  background: #4CAF50;
  color: white;
  text-align: center;
  padding: 10px;
  width: 100%;
  margin-top: 18px;
}

/* sidebar lists */
.sidebar h3 { margin-top: 0; }
.sidebar ul { list-style: none; padding: 0; margin: 0; }
.sidebar li { margin-bottom: 8px; }
.sidebar a { color: #4CAF50; text-decoration: none; font-weight: 500; }

/* small tweaks */
@media (max-width: 980px) {
  .post-full { padding: 18px; }
  .post-full h2 { font-size: 22px; }
  .meta { font-size: 0.92rem; }
  .container { padding: 0 12px; gap: 12px; }
}

/* mobile layout */
@media (max-width: 820px) {
  header h1 { font-size: 18px; }
  header p { font-size: 12px; }
  .mobile-menu-btn { display: block; }
  .container { flex-direction: column; padding: 0 12px; gap: 10px; }
  .sidebar { display: none; } /* desktop sidebar hidden on mobile */
  main { padding: 6px 0; align-items: stretch; }
  .post-full { width: 100%; padding: 16px; border-radius: 10px; }
  .post-full h2 { font-size: 20px; }
  .meta { font-size: 0.88rem; }
  .back-btn { padding: 9px 12px; }
}

/* extra small phones */
@media (max-width: 420px) {
  .post-full { padding: 14px; }
  .post-full h2 { font-size: 18px; }
  .meta { font-size: 0.82rem; }
  .back-btn { padding: 8px 10px; font-size: 0.95rem; }
}
</style>
</head>
<body>

<?php include "header.php" ?>
<!-- MOBILE SIDEBAR (slides from right) -->
<div id="mobileSidebar" class="mobile-sidebar" aria-hidden="true">
  <button class="close-btn" onclick="toggleSidebar()" aria-label="Close sidebar">&times;</button>

  <h3>Categories</h3>
  <ul>
    <li><a href="index.php?cat=General">General</a></li>
    <li><a href="index.php?cat=Web%20Development">Web Development</a></li>
    <li><a href="index.php?cat=JavaScript">JavaScript</a></li>
    <li><a href="index.php?cat=Lifestyle">Lifestyle</a></li>
    <li><a href="index.php?cat=Personal">Personal</a></li>
  </ul>

  <h3>Recent Posts</h3>
  <ul>
    <?php foreach ($recentPosts as $rp): ?>
      <li><a href="post.php?id=<?= (int)$rp['id'] ?>"><?= htmlspecialchars($rp['title']) ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="container">
  <main>
    <article class="post-full" role="article" aria-labelledby="post-title">
    <h2 id="post-title"><?php echo $post['title'] ?></h2>

      <div class="meta">
        By <a id="author_link" href="author_page.php?username=<?php echo $post['author'];?>" </a> <?php  echo $post['author']?></a> on <span><?php echo $post['date_created'] ?></span>
        <?php if (!empty($post['category'])): ?>
          · <span style="color:#4CAF50; font-weight:600;"><?= htmlspecialchars($post['category']) ?></span>
        <?php endif; ?>
      </div>

      <div class="content">
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
      </div>

      <a href="index.php" class="back-btn" aria-label="Back to posts">⬅ Back</a>
    </article>
  </main>

  <!-- DESKTOP SIDEBAR -->
  <aside class="sidebar" aria-labelledby="sidebar-title">
    <h3 id="sidebar-title">Categories</h3>
    <ul>
      <li><a href="index.php?cat=General">General</a></li>
      <li><a href="index.php?cat=Web%20Development">Web Development</a></li>
      <li><a href="index.php?cat=JavaScript">JavaScript</a></li>
      <li><a href="index.php?cat=Lifestyle">Lifestyle</a></li>
      <li><a href="index.php?cat=Personal">Personal</a></li>
    </ul>

    <h3>Recent Posts</h3>
    <ul>
      <?php foreach ($recentPosts as $rp): ?>
        <li><a href="post.php?id=<?= (int)$rp['id'] ?>"><?= htmlspecialchars($rp['title']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </aside>
</div>

<footer>&copy; 2025 WriteIt. All rights reserved.</footer>

<script>
function toggleSidebar() {
  const side = document.getElementById('mobileSidebar');
  const isOpen = side.classList.toggle('open');
  side.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
}
</script>
</body>
</html>
