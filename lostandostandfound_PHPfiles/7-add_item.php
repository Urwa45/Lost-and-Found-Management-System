<?php
session_start();
include 'DB.php';

// Only allow logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: 3-login.html");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $category = trim($_POST["category"]);
    $location = trim($_POST["location"]);
    $date_lost = $_POST["date_lost"];
    $status = $_POST["status"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO items (title, description, category, location, date_lost, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $title, $description, $category, $location, $date_lost, $status, $user_id);

    if ($stmt->execute()) {
        $message = "✅ Item added successfully!";
    } else {
        $message = "❌ Error adding item.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Lost Item</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #ff4500;
      font-family: 'Inter', sans-serif;
    }
    .header .container {
      background-color: #1e1e1e;
      box-shadow: 0 0 10px #ff4500cc;
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 30px;
    }
    .header h1 {
      color: #ff4500;
      text-shadow: 1px 1px 3px black;
    }
    .nav a.btn {
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
    .nav a.btn:hover {
      background-color: #ff6347;
      box-shadow: 0 0 20px #ff6347cc;
    }
    main.container {
      max-width: 600px;
      margin: auto;
    }
    form.add-form {
      background: rgba(20, 20, 20, 0.85);
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px #ff4500cc;
      color: #ff4500;
      font-weight: 600;
      letter-spacing: 0.05em;
    }
    form.add-form h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #ff4500;
      text-shadow: 1px 1px 3px black;
    }
    form.add-form label {
      display: block;
      margin: 12px 0 6px;
      color: #ffa07a;
    }
    form.add-form input[type="text"],
    form.add-form input[type="date"],
    form.add-form textarea,
    form.add-form select {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #222;
      color: #fff;
      font-size: 16px;
      box-shadow: inset 0 0 8px #ff4500cc;
      transition: box-shadow 0.3s ease;
    }
    form.add-form input:focus,
    form.add-form textarea:focus,
    form.add-form select:focus {
      outline: none;
      box-shadow: 0 0 12px #ff4500;
      background: #2b2b2b;
    }
    form.add-form button {
      margin-top: 20px;
      width: 100%;
      background: #ff4500;
      border: none;
      padding: 15px 0;
      color: #fff;
      font-size: 18px;
      font-weight: 700;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 0 15px #ff4500cc;
      transition: background 0.3s ease;
    }
    form.add-form button:hover {
      background: #ff6347;
      box-shadow: 0 0 25px #ff6347cc;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Add Lost Item</h1>
      <nav class="nav">
        <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>" class="btn">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <?php if (!empty($message)): ?>
      <p style="color: limegreen; text-align: center;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form class="add-form" method="POST" action="7-add_item.php" enctype="multipart/form-data">
  <h2>Report a Lost Item</h2>

  <label for="title">Item Name</label>
  <input type="text" id="title" name="title" placeholder="e.g., Wallet" required>

  <label for="description">Description</label>
  <textarea id="description" name="description" rows="4" placeholder="Describe the item..." required></textarea>

  <label for="location">Lost Location</label>
  <input type="text" id="location" name="location" placeholder="e.g., Library" required>

  <label for="date_lost">Date Lost</label>
  <input type="date" id="date_lost" name="date_lost" required>

  <label for="category">Category</label>
  <select name="category" id="category" required>
    <option value="">-- Select Category --</option>
    <option value="Electronics">Electronics</option>
    <option value="Clothing">Clothing</option>
    <option value="Books">Books</option>
  </select>

  <label for="status">Status</label>
  <select name="status" id="status" required>
    <option value="">-- Select Status --</option>
    <option value="lost">Lost</option>
    <option value="found">Found</option>
  </select>


  <button type="submit">Submit Report</button>
</form>

  </main>

  <footer class="footer">
    <p>&copy; 2025 Lost & Found | Add Item</p>
  </footer>
</body>
</html>
