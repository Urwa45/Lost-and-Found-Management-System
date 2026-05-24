<!DOCTYPE html>
<html>
  <head>
    <title>Lost & Found - University</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js" defer></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #121212;
        color: #ff4500;
        font-family: "Inter", sans-serif;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
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

      main.hero {
        flex-grow: 1;
        background: linear-gradient(
            rgba(18, 18, 18, 0.85),
            rgba(18, 18, 18, 0.85)
          ),
          url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 80px 20px;
        color: #ff4500;
        text-shadow: 2px 2px 6px black;
      }
      main.hero h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        font-weight: 700;
      }
      main.hero p {
        font-size: 1.3rem;
        max-width: 600px;
        margin-bottom: 40px;
        font-weight: 500;
      }
      main.hero .btn-group {
        display: flex;
        gap: 25px;
      }
      main.hero .btn-group a.btn {
        background-color: #ff4500;
        padding: 16px 30px;
        font-size: 1.2rem;
        border-radius: 15px;
        font-weight: 700;
        box-shadow: 0 0 20px #ff4500cc;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
      }
      main.hero .btn-group a.btn:hover {
        background-color: #ff6347;
        box-shadow: 0 0 35px #ff6347cc;
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
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>Lost & Found</h1>
        <nav class="nav">
          <a href="Register.php" class="btn">Register</a>
          <a href="Login.php" class="btn">Login</a>
          <a href="contact-us.php" class="btn">Contact</a>
          <a href="about.php" class="btn">About Us</a>
        </nav>
      </div>
    </header>

    <main class="hero">
      <h1>Welcome to University Lost & Found System</h1>
      <p>
        Easily report, track, and recover lost items on campus. Join our
        community to keep your belongings safe.
      </p>
      <div class="btn-group">
        <a href="Register.php" class="btn">Get Started</a>
        <a href="Login.php" class="btn">Login</a>
      </div>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
    </footer>
  </body>
</html>
