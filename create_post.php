<?php session_start();
// If already logged in, redirect to index.php
if (!isset($_SESSION['user_id'])) {
  header("Location: loginpage.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Post</title>

  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #fdfcfb;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    header {
      background-color: #4CAF50;
      color: white;
      width: 100%;
      text-align: center;
      padding: 15px 0;
      font-size: 24px;
      font-weight: bold;
    }

    main {
      background: white;
      margin-top: 20px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 800px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    textarea {
      height: 300px;
      font-family: 'Courier New', monospace;
      resize: vertical;
      white-space: pre-wrap;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 12px;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #388E3C;
    }

    footer {
      text-align: center;
      background: #333;
      color: white;
      width: 100%;
      padding: 10px;
      margin-top: auto;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <header>✍️ Create New Post</header>

  <main>
    <!-- FORM START -->
    <form action="save_post.php" method="POST">

      <label>Title:</label>
      <input type="text" name="title" required placeholder="Enter your blog title">

      <!-- <label>Author:</label>
      <input type="text" name="author" readonly required value="<?php echo $_SESSION['username'] ?>"> -->

      <label>Category:</label>
      <select name="category">
        <option value="General">General</option>
        <option value="Web Development">Web Development</option>
        <option value="JavaScript">JavaScript</option>
        <option value="Lifestyle">Lifestyle</option>
        <option value="Personal">Personal</option>
      </select>

      <label>Write your post:</label>
      <textarea name="content" required placeholder="Start writing here..."></textarea>

      <button type="submit">Save Post</button>

    </form>
    <!-- FORM END -->
  </main>

  <footer>
    &copy; 2025 Multi-User Blog. All rights reserved.
  </footer>

</body>

</html>