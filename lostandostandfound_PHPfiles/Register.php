<?php
include 'DB.php';

$message = ""; // Prepare to show user feedback

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm-password"]);

    if ($password !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Username or email already exists!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $message = "Registration successful! <a href='Login.php'>Login here</a>.";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $check->close();
        $conn->close();
    }
}
?>


<!-- 1. register.html -->
 <!DOCTYPE html>
<html>
  <head>
    <title>Register - Lost & Found</title>
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

      main.register-container {
        background: rgba(20, 20, 20, 0.9);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
        width: 400px;
        text-align: center;
        margin: 40px auto;
        flex-grow: 1;
      }
      main.register-container h1 {
        margin-bottom: 2px;
        font-size: 2rem;
        color: #ff4500;
        text-shadow: 1px 1px 4px black;
      }
      main.register-container form {
        display: flex;
        flex-direction: column;
        gap: 3px;
      }
      main.register-container label {
        text-align: left;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 3px;
        color: #ffa07a;
      }
      main.register-container input[type="text"],
      main.register-container input[type="email"],
      main.register-container input[type="password"] {
        padding: 12px 15px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
      }
      main.register-container input[type="text"]:focus,
      main.register-container input[type="email"]:focus,
      main.register-container input[type="password"]:focus {
        box-shadow: 0 0 8px #ff4500cc;
      }
      main.register-container button {
        background-color: #ff4500;
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 700;
        padding: 12px 0;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 0 15px #ff4500cc;
        transition: background-color 0.3s ease;
      }
      main.register-container button:hover {
        background-color: #ff6347;
        box-shadow: 0 0 25px #ff6347cc;
      }
      main.register-container .login-link {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #ffa07a;
      }
      main.register-container .login-link a {
        color: #ff4500;
        font-weight: 600;
        text-decoration: none;
      }
      main.register-container .login-link a:hover {
        text-decoration: underline;
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
          <a href="index.php" class="btn">Home</a>
          <a href="Login.php" class="btn">Login</a>
        </nav>
      </div>
    </header>

    <main class="register-container">

    <div id="form-messages">
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
    </div>

     
      <h1>Register</h1>
      <form action="Register.php" method="POST">
        
        <div id="form-messages"></div>
        <label for="username">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Choose a username"
          required
        />
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Enter your email"
          required
        />
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Create a password"
          required
        />
        <label for="confirm-password">Confirm Password</label>
        <input
          type="password"
          id="confirm-password"
          name="confirm-password"
          placeholder="Confirm your password"
          required
        />
        <button type="submit">Register</button>
      </form>
      <p class="login-link">
        Already have an account?
        <a href="Login.php">Log in here</a>
      </p>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
      

    </footer>
  </body>
</html>
