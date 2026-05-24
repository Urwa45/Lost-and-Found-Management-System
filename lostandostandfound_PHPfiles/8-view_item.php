<!-- 9. view-items.html -->
 <?php
session_start();
include 'DB.php';

// Only allow logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: 3-login.html");
    exit();
}

// Fetch only items with status "found"
$stmt = $conn->prepare("SELECT title, description, category, location, date_lost FROM items WHERE status = 'found' ORDER BY date_lost DESC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Found Items</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #ff4500;
      font-family: 'Inter', sans-serif;
    }
    .header .container, .footer {
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
      max-width: 900px;
      margin: auto;
    }
    .items-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 25px;
    }
    .item-card {
      background: #1e1e1e;
      border-radius: 15px;
      box-shadow: 0 0 15px #ff4500cc;
      padding: 20px;
      text-align: center;
    }
    .item-card:hover {
      box-shadow: 0 0 30px #ff4500;
    }
    .item-card h2 {
      color: #ff4500;
      margin-bottom: 10px;
      text-shadow: 1px 1px 3px black;
    }
    .item-card p {
      color: #ffa07a;
      margin: 5px 0;
    }
    footer.footer {
      text-align: center;
      color: #ff4500;
      margin-top: 50px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <nav class="nav">
        <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>" class="btn">Dashboard</a>
        <a href="/lostandfound/logout.php" class="btn">Logout</a>

      </nav>
      <h1>🔎 Found Items</h1>
    </div>
  </header>

  <main class="container">
    <section class="items-grid">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="item-card">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date_lost']); ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align:center;">No found items reported yet.</p>
      <?php endif; ?>
    </section>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Lost & Found | View Found Items</p>
  </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>



