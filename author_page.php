<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Profile</title>

    <style>
        /* GLOBAL */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f3f3;
        }

        /* HEADER */
        header {
            background: #4CAF50;
            padding: 15px 22px;
            color: white;
            font-size: 22px;
        }

        /* PAGE GRID */
        .page {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 12px;
            gap: 22px;
        }

        /* LEFT PROFILE CARD */
        .left-card {
            width: 280px;
            background: white;
            padding: 22px;
            border-radius: 12px;
            height: fit-content;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 20px;
        }

        /* PROFILE IMAGE */
        .left-card .profile-pic {
            width: 110px;
            height: 110px;
            background: #4CAF50;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
        }

        .left-card h2 {
            text-align: center;
            margin-top: 14px;
        }

        .left-card p {
            text-align: center;
            color: #666;
        }

        /* STATS */
        .stats {
            margin: 20px 0;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .stats div span {
            font-weight: bold;
            color: #333;
        }

        /* BUTTONS */
        .left-card button {
            width: 100%;
            padding: 10px 0;
            margin: 6px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .follow-btn {
            background: #4CAF50;
            color: white;
        }

        .msg-btn {
            background: #e6e6e6;
            color: #333;
        }

        /* POSTS SECTION (MIDDLE BUT RIGHT-LEANED) */
        .posts {
            flex: 1;
            max-width: 680px;
            /* Controls right alignment */
            margin-left: auto;
            /* Pushes it slightly right */
        }

        /* EACH POST */
        .post {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
            margin-bottom: 18px;
        }

        .post h3 {
            margin: 0 0 8px;
        }

        .meta {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 12px;
        }

        .read-more {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 9px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* FOOTER */
        footer {
            background: #4CAF50;
            color: white;
            text-align: center;
            padding: 12px;
            width: 100%;

        }

        /* RESPONSIVE */
        @media(max-width: 850px) {
            .page {
                flex-direction: column;
            }

            .left-card {
                width: 100%;
                position: static;
            }

            .posts {
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <?php include "header.php" ?>

    <div class="page">

        <!-- LEFT FIXED PROFILE CARD -->
        <aside class="left-card">
            <div class="profile-pic">A</div>
            <h2>Author Name</h2>
            <p>Writer • Developer • Creator</p>

            <div class="stats">
                <div><span>42</span><br>Posts</div>
                <div><span>3.4K</span><br>Followers</div>
                <div><span>198</span><br>Following</div>
            </div>

            <button class="follow-btn">Follow</button>
            <button class="msg-btn">Message</button>
        </aside>

        <!-- MIDDLE FEED (SLIGHTLY RIGHT-sided) -->
        <main class="posts">

            <div class="post">
                <h3>My First Blog Post</h3>
                <div class="meta">Jan 24, 2025 • Lifestyle</div>
                <p>This is a short preview of the post content. It introduces your blog entry...</p>
                <button class="read-more">Read More</button>
            </div>

            <div class="post">
                <h3>Web Development Tips</h3>
                <div class="meta">Jan 20, 2025 • Web Development</div>
                <p>Here are some useful tips for new programmers exploring the world of web development…</p>
                <button class="read-more">Read More</button>
            </div>

        </main>

    </div>

    <footer>&copy; 2025 WriteIt. All rights reserved.</footer>

</body>

</html>