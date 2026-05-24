<?php
session_start();
include 'DB.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: 3-login.html");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_id = $_POST["item_id"] ?? null;
    $title = $_POST["title"] ?? '';
    $description = $_POST["description"] ?? '';
    $date_lost = $_POST["date_lost"] ?? '';
    $location = $_POST["location"] ?? '';
    $user_id = $_SESSION["user_id"];

    if ($item_id && $title && $description && $date_lost && $location) {
        $stmt = $conn->prepare("UPDATE items SET title = ?, description = ?, date_lost = ?, location = ? WHERE id = ? AND user_id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssii", $title, $description, $date_lost, $location, $item_id, $user_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $message = "Item updated successfully.";
            } else {
                $message = "Update failed. Item not found or you don't have permission.";
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
    <title>Update Lost Item - Lost & Found</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
      /* [Your original CSS remains unchanged] */
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

      main.update-container {
        background: rgba(20, 20, 20, 0.9);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 0 25px #ff4500cc;
        width: 400px;
        text-align: center;
        margin: 40px auto;
        flex-grow: 1;
      }
      main.update-container h1 {
        margin-bottom: 25px;
        font-size: 2rem;
        color: #ff4500;
        text-shadow: 1px 1px 4px black;
      }
      main.update-container form {
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      main.update-container label {
        text-align: left;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 5px;
        color: #ffa07a;
      }
      main.update-container input[type="text"],
      main.update-container input[type="date"],
      main.update-container input[type="number"],
      main.update-container select,
      main.update-container textarea {
        padding: 12px 15px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        resize: vertical;
      }
      main.update-container input:focus,
      main.update-container select:focus,
      main.update-container textarea:focus {
        box-shadow: 0 0 8px #ff4500cc;
      }
      main.update-container button {
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
      main.update-container button:hover {
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
        margin-top: 10px;
        color: lightgreen;
        font-weight: bold;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>Lost & Found</h1>
        <nav class="nav">
          <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>" class="btn">Dashboard</a>
          <a href="logout.php" class="btn">Logout</a>
        </nav>
      </div>
    </header>

    <main class="update-container">
      <h1>Update Lost Item</h1>
      <?php if (!empty($message)) echo "<p class='msg'>$message</p>"; ?>

      <form class="styled-form" method="POST" action="update-item.php">
        <label for="item-id">Item ID</label>
        <input type="number" id="item-id" name="item_id" placeholder="Enter item ID" required />

        <label for="item-name">Item Name</label>
        <input type="text" id="item-name" name="title" placeholder="Enter item name" required />

        <label for="item-description">Description</label>
        <textarea id="item-description" name="description" placeholder="Describe the item" rows="4" required></textarea>

        <label for="date-lost">Date Lost</label>
        <input type="date" id="date-lost" name="date_lost" required />

        <label for="location-lost">Location Lost</label>
        <input type="text" id="location-lost" name="location" placeholder="Where was it lost?" required />

        <button type="submit">Update Item</button>
      </form>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | All rights reserved.</p>
    </footer>
  </body>
</html>
