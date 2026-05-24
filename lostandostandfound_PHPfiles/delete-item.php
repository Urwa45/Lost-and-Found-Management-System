<?php
session_start();
include 'DB.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'] ?? null;
    $item_name = $_POST['item_name'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!empty($item_id)) {
        $query = "DELETE FROM items WHERE user_id = ? AND id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ii", $user_id, $item_id);
    } elseif (!empty($item_name)) {
        $query = "DELETE FROM items WHERE user_id = ? AND title = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $user_id, $item_name);
    } else {
        $message = "⚠️ Please enter either Item ID or Item Name.";
        goto view;
    }

    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $message = "✅ Item deleted successfully.";
    } else {
        $message = "⚠️ No matching item found or you don't have permission.";
    }
    $stmt->close();
}

view:
?>


<!DOCTYPE html>
<html>
<head>
  <title>Delete Lost Item - Lost & Found</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
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
    main.delete-container {
      background: rgba(20, 20, 20, 0.9);
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 0 25px #ff4500cc;
      width: 400px;
      text-align: center;
      margin: 40px auto;
      flex-grow: 1;
    }
    main.delete-container h1 {
      margin-bottom: 5px;
      font-size: 2rem;
      color: #ff4500;
      text-shadow: 1px 1px 4px black;
    }
    main.delete-container form {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    main.delete-container input[type="text"],
    main.delete-container input[type="number"] {
      padding: 12px 15px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      outline: none;
    }
    main.delete-container input:focus {
      box-shadow: 0 0 8px #ff4500cc;
    }
    main.delete-container button {
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
    main.delete-container button:hover {
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
      margin-top: 15px;
      font-weight: bold;
      color: lightgreen;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Lost & Found</h1>
      <nav class="nav">
        <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>" class="btn">Dashboard</a>
        <a href="index.php" class="btn">Home</a>
        <a href="Logout.php" class="btn">Logout</a>
      </nav>
    </div>
  </header>

  <main class="delete-container">
    <h1>Delete Lost Item</h1>
    <?php if (!empty($message)): ?>
      <p class="msg"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="delete-item.php">
      <label for="item-id">Item ID</label>
      <input type="number" id="item-id" name="item_id" placeholder="Enter the ID of the item to delete" />

      <label for="item-name">Or Item Name</label>
      <input type="text" id="item-name" name="item_name" placeholder="Enter the name of the item" />

      <button type="submit">Delete Item</button>
    </form>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Lost & Found | All rights reserved.</p>
  </footer>
</body>
</html>
