<?php
session_start();
include 'DB.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email)) {
        if (!empty($password)) {
            // Hash new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);
        } else {
            // Update without changing password
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $email, $user_id);
        }

        if ($stmt->execute()) {
            $message = "Profile updated successfully!";
        } else {
            $message = "Update failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Username and Email are required.";
    }
}

// Load current user data
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
      body {
        background-color: #121212;
        color: #ff4500;
        font-family: "Inter", sans-serif;
        margin: 0;
        padding: 0;
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

      main.container {
        max-width: 600px;
        margin: 40px auto;
      }

      form.styled-form {
        background: rgba(20, 20, 20, 0.9);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      form.styled-form h2 {
        text-align: center;
        margin-bottom: 10px;
        font-size: 1.8rem;
        color: #ff4500;
        text-shadow: 1px 1px 3px black;
      }

      form.styled-form label {
        text-align: left;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 3px;
        color: #ffa07a;
      }

      form.styled-form input[type="text"],
      form.styled-form input[type="email"],
      form.styled-form input[type="password"] {
        padding: 12px 15px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        background-color: #222;
        color: #fff;
        box-shadow: inset 0 0 8px #ff4500cc;
        transition: box-shadow 0.3s ease, background 0.3s ease;
      }

      form.styled-form input[type="text"]:focus,
      form.styled-form input[type="email"]:focus,
      form.styled-form input[type="password"]:focus {
        box-shadow: 0 0 12px #ff4500;
        background-color: #2b2b2b;
      }

      form.styled-form button {
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
        margin-top: 15px;
      }

      form.styled-form button:hover {
        background-color: #ff6347;
        box-shadow: 0 0 25px #ff6347cc;
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
        margin-top: 40px;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>User Profile</h1>
        <nav class="nav">
          <a href="user-dashboard.php" class="btn">Dashboard</a>
          <a href="Logout.php" class="btn">Logout</a>
        </nav>
      </div>
    </header>

    <main class="container">
  <form class="styled-form" action="user-profile.php" method="POST">
    <div id="form-messages"><?php if (!empty($message)) echo "<p>$message</p>"; ?></div>
    <h2>Your Profile Details</h2>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required />

    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required />

    <label for="password">Change Password</label>
    <input type="password" id="password" name="password" placeholder="New Password" />

    <button type="submit">Update Profile</button>
  </form>
</main>


    <footer class="footer">
      <p>&copy; 2025 Lost & Found | User Profile</p>
    </footer>
  </body>
</html>
