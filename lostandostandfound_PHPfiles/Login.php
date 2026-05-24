<?php
session_start();
include 'DB.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $selectedRole = $_POST["role"];

    $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $email, $hashedPassword, $roleInDB);
        $stmt->fetch();
        echo "Typed password: " . $password . "<br>";
        echo "Stored hash: " . $hashedPassword . "<br>";

        if (password_verify($password, $hashedPassword)) {
            if ($selectedRole === $roleInDB) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $roleInDB;

                if ($roleInDB === 'admin') {
                    header("Location: admin-dashboard.php");
                    exit();
                } elseif ($roleInDB === 'user') {
                    header("Location: user-dashboard.php");
                    exit();
                }
            } else {
                $message = "❌ Incorrect role selected. You are registered as '$roleInDB'.";
            }
        } else {
            $message = "❌ Incorrect password.";
        }
    } else {
        $message = "❌ No user found with that username or email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- 2. login.html -->
 <!DOCTYPE html>
<html>
  <head>
    <title>Login - Lost & Found</title>
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

      main.login-container {
        background: rgba(20, 20, 20, 0.9);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
        width: 350px;
        text-align: center;
        margin: 40px auto;
        flex-grow: 1;
      }
      main.login-container h1 {
        margin-bottom: 2px;
        font-size: 2rem;
        color: #ff4500;
        text-shadow: 1px 1px 4px black;
      }
      main.login-container form {
        display: flex;
        flex-direction: column;
        gap: 2px;
      }
      main.login-container label {
        text-align: left;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 2px;
        color: #ffa07a;
      }
      main.login-container input[type="text"],
      main.login-container input[type="password"] {
        padding: 12px 15px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
      }
      main.login-container input[type="text"]:focus,
      main.login-container input[type="password"]:focus {
        box-shadow: 0 0 8px #ff4500cc;
      }
      main.login-container button {
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
      main.login-container button:hover {
        background-color: #ff6347;
        box-shadow: 0 0 25px #ff6347cc;
      }
      main.login-container .register-link {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #ffa07a;
      }
      main.login-container .register-link a {
        color: #ff4500;
        font-weight: 600;
        text-decoration: none;
      }
      main.login-container .register-link a:hover {
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
          <a href="Register.php" class="btn">Register</a>
        </nav>
      </div>
    </header>

    <main class="login-container">
     
      <h1>Login</h1>
      <form class="styled-form" action="Login.php" method="POST">
       <div id="form-messages">
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
    </div>

        <label for="username">Username or Email</label>
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Enter your username or email"
          required
        />

        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Enter your password"
          required
        />
        <label for="role">Login as:</label>
        <select id="role" name="role" required>
        <option value="">--Select Role--</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
</select>

        <button type="submit">Log In</button>
      </form>
      <p class="register-link">
        Don't have an account?
        <a href="Register.php">Register here</a>
      </p>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
     

    </footer>
  </body>
</html>
