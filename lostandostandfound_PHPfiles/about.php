<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>About Us - Lost & Found</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
      body {
        background-color: #121212;
        color: #ff4500;
        font-family: "Inter", sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }
      header.header {
        background-color: #1e1e1e;
        box-shadow: 0 0 10px #ff4500cc;
        padding: 15px 20px;
        border-radius: 0 0 15px 15px;
      }
      header .container {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      header h1 {
        color: #ff4500;
        text-shadow: 1px 1px 3px black;
        font-weight: 700;
      }
      nav.nav a.btn {
        background-color: #ff4500;
        color: #fff;
        padding: 10px 18px;
        margin-left: 10px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 0 10px #ff4500cc;
        transition: background-color 0.3s ease;
      }
      nav.nav a.btn:hover {
        background-color: #ff6347;
        box-shadow: 0 0 20px #ff6347cc;
      }
      .about-content {
        max-width: 900px;
        margin: 50px auto;
        padding: 40px;
        background-color: rgba(30, 30, 30, 0.95);
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
      }
      .about-content h2 {
        font-size: 2rem;
        color: #ff4500;
        margin-bottom: 20px;
        text-shadow: 1px 1px 3px black;
      }
      .about-content p {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #ffe4c4;
      }
      footer.footer {
        background-color: #1e1e1e;
        box-shadow: 0 -2px 10px #ff4500cc;
        padding: 15px 20px;
        border-radius: 15px 15px 0 0;
        text-align: center;
        color: #ff4500;
        font-weight: 600;
        text-shadow: 1px 1px 3px black;
        margin-top: auto;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>Lost & Found</h1>
        <nav class="nav">
          <a href="index.php" class="btn">Home</a>
          <a href="contact-us.php" class="btn">Contact</a>
          <?php if ($isLoggedIn): ?>
            <a href="Logout.php" class="btn">Logout</a>
          <?php else: ?>
            <a href="Login.php" class="btn">Login</a>
          <?php endif; ?>
        </nav>
      </div>
    </header>

    <section class="about-content">
      <h2>About Us</h2>
      <p>
        The Lost & Found Management System is designed to help university students and staff report, find, and track lost or found items in an organized and secure manner. We aim to reduce the chaos and frustration that often follows the misplacement of personal belongings on campus.
      </p>
      <p>
        This system allows users to register, log in, and report lost or found items easily. Admins can oversee all reports, validate findings, and keep the database updated. Our mission is to build a trustworthy and efficient platform where everyone feels supported when they lose or find something valuable.
      </p>
      <p>
        Whether it's a lost ID card, keys, mobile device, or a found backpack, we provide a centralized location to report and retrieve such items with just a few clicks.
      </p>
    </section>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
    </footer>
  </body>
</html>
