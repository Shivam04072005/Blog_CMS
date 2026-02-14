<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - WriteIt</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f8f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ---------------- HEADER ---------------- */
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

        /* MOBILE */
        .mobile-menu-btn {
            font-size: 28px;
            cursor: pointer;
            display: none;
            color: white;
        }

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

        @media (max-width: 820px) {
            .menu-bar {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        /* ---------------- REGISTER FORM ---------------- */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 20px;
        }

        main {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 450px;
        }

        main h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        button[type="submit"] {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: 0.2s;
        }

        button[type="submit"]:hover {
            background: #388E3C;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: 500;
        }

        /* FOOTER */
        footer {
            background: #4CAF50;
            color: white;
            text-align: center;
            padding: 12px;
        }
    </style>
</head>

<body>

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
                <button class="menu-btn"><a href="loginpage.php">Login</a></button>
            </div>
        </div>
    </header>

    <div id="sidebar" class="sidebar">
        <button class="menu-btn"><a href="loginpage.php">Login</a></button>
        <button class="menu-btn"><a href="index.php">Home</a></button>
    </div>

    <div class="container">
        <main>
            <h2>Create Account</h2>

            <form method="POST" action="register_process.php">
                <label>Full Name</label>
                <input type="text" name="fname" required>

                <label>Username</label>
                <input type="text" name="username" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>

                <button type="submit">Register</button>

            </form>

            <div class="login-link">
                <a href="loginpage.php">Already have an account? Login here</a>
            </div>

        </main>
    </div>

    <footer>&copy; 2025 WriteIt. All rights reserved.</footer>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }
    </script>

</body>

</html>