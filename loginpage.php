
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Login - WriteIt</title>

<style>
/* ---------------- GLOBAL DESIGN (adapted from index.php) ---------------- */
* { box-sizing: border-box; }
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
  text-align: center;
}
header h1 {
  margin: 0;
  font-size: 22px;
}
header p {
  margin: 3px 0 0;
  font-size: 14px;
}

/* ---------------- MAIN LAYOUT ---------------- */
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  max-width: 1100px;
  margin: 18px auto;
  width: 100%;
  padding: 0 16px;
  flex: 1;
}

main {
  background: white;
  padding: 32px;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
  width: 100%;
  max-width: 400px;
}

main h2 {
  margin-top: 0;
  text-align: center;
  color: #333;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 4px;
  font-weight: 600;
  color: #555;
}

input[type="text"], input[type="password"] {
  padding: 10px;
  margin-bottom: 16px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 16px;
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
  box-shadow: 0 3px 6px rgba(0,0,0,0.12);
  transition: background 0.2s;
}

button:hover {
  background: #388E3C;
}

.error {
  color: red;
  text-align: center;
  margin-bottom: 16px;
}

.register-link {
  text-align: center;
  margin-top: 16px;
}

.register-link a {
  color: #4CAF50;
  text-decoration: none;
  font-weight: 500;
}

/* ---------------- FOOTER ---------------- */
footer {
  background: #4CAF50;
  color: white;
  text-align: center;
  padding: 12px;
  width: 100%;
}

/* ---------------- RESPONSIVE BREAKPOINTS ---------------- */
@media (max-width: 420px) {
  main { padding: 24px; }
  header h1 { font-size: 20px; }
}
</style>
</head>
<body>
<?php include "header.php" ?>

<div class="container">
  <main>
    <h2>Login</h2>
    <form method="POST" action="login.php">
      <label for="username">Username or Email:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
    <div class="register-link">
      <a href="register.php">Don't have an account? Register here</a>
    </div>
  </main>
</div>

<footer>&copy; 2025 WriteIt. All rights reserved.</footer>

</body>
</html>
