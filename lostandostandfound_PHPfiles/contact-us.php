<?php
include 'DB.php'; // Ensure this contains a working $conn

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $userMessage = trim($_POST["message"]);

    if ($name && $email && $userMessage) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $userMessage);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $message = "Thank you! Your message has been sent.";
            } else {
                $message = "Failed to send your message. Try again.";
            }

            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    } else {
        $message = "All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Contact Us - Lost & Found</title>
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

      main.contact-container {
        background: rgba(20, 20, 20, 0.9);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
        width: 400px;
        text-align: center;
        margin: 40px auto;
        flex-grow: 1;
      }
      main.contact-container h1 {
        margin-bottom: 2px;
        font-size: 2rem;
        color: #ff4500;
        text-shadow: 1px 1px 4px black;
      }
      main.contact-container form {
        display: flex;
        flex-direction: column;
        gap: 2px;
      }
      main.contact-container label {
        text-align: left;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 5px;
        color: #ffa07a;
      }
      main.contact-container input[type="text"],
      main.contact-container input[type="email"],
      main.contact-container textarea {
        padding: 12px 15px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        resize: vertical;
      }
      main.contact-container input[type="text"]:focus,
      main.contact-container input[type="email"]:focus,
      main.contact-container textarea:focus {
        box-shadow: 0 0 8px #ff4500cc;
      }
      main.contact-container button {
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
      main.contact-container button:hover {
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
      }
      .msg {
        color: lightgreen;
        margin: 10px 0;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>Lost & Found</h1>
        <nav class="nav">
          <a href="index.php" class="btn">Home</a>
          <a href="user-profile.php" class="btn">Profile</a>
          <a href="about.php" class="btn">About Us</a>
          <a href="Logout.php" class="btn">Logout</a>
        </nav>
      </div>
    </header>

    <main class="contact-container">
      <h1>Contact Us</h1>
      <?php if (!empty($message)) echo "<p class='msg'>" . htmlspecialchars($message) . "</p>"; ?>

      <form class="styled-form" method="POST" action="contact-us.php">
        <label for="name">Your Name</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Enter your full name"
          required
        />

        <label for="email">Your Email</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Enter your email address"
          required
        />

        <label for="message">Message</label>
        <textarea
          id="message"
          name="message"
          placeholder="Write your message here"
          rows="5"
          required
        ></textarea>

        <button type="submit">Send Message</button>
      </form>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
    </footer>
  </body>
</html>
