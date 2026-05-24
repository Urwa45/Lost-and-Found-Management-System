<?php
session_start();
include 'DB.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

// Initialize search variables
$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '';
$date = $_GET['date'] ?? '';
$result = null;

// Only run the search if any search input is provided
if (!empty($keyword) || !empty($category) || !empty($date)) {
    $query = "SELECT title, description, category, location, date_lost, status FROM items WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($keyword)) {
        $query .= " AND (title LIKE ? OR description LIKE ?)";
        $params[] = "%$keyword%";
        $params[] = "%$keyword%";
        $types .= 'ss';
    }

    if (!empty($category)) {
        $query .= " AND category = ?";
        $params[] = $category;
        $types .= 's';
    }

    if (!empty($date)) {
        $query .= " AND date_lost = ?";
        $params[] = $date;
        $types .= 's';
    }

    $query .= " ORDER BY date_lost DESC";
    $stmt = $conn->prepare($query);

    if ($params) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Items - Lost & Found</title>
  <link rel="stylesheet" href="styles.css" />
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
    .search-section {
      max-width: 900px;
      margin: 50px auto;
      padding: 40px;
      background-color: rgba(30, 30, 30, 0.95);
      border-radius: 15px;
      box-shadow: 0 0 25px #ff4500cc;
    }
    .search-section h2 {
      font-size: 2rem;
      color: #ff4500;
      margin-bottom: 20px;
      text-shadow: 1px 1px 3px black;
    }
    form label {
      display: block;
      margin: 10px 0 5px;
      color: #ffe4c4;
    }
    form input,
    form select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      background-color: #333;
      color: white;
      margin-bottom: 20px;
      box-shadow: 0 0 10px #00000066;
    }
    .btn-search {
      background-color: #ff4500;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      box-shadow: 0 0 15px #ff4500aa;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-search:hover {
      background-color: #ff6347;
      box-shadow: 0 0 20px #ff6347cc;
    }
    .items-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }
    .item-card {
      background: #1e1e1e;
      border-radius: 15px;
      box-shadow: 0 0 15px #ff4500cc;
      padding: 20px;
      text-align: center;
    }
    .item-card h2 {
      color: #ff4500;
      margin-bottom: 10px;
    }
    .item-card p {
      color: #ffa07a;
      margin: 5px 0;
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
        <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>" class="btn">Dashboard</a>
        <a href="Logout.php" class="btn">Logout</a>
      </nav>
    </div>
  </header>

  <section class="search-section">
    <h2>Search Lost or Found Items</h2>
    <form class="styled-form" action="search-items.php" method="GET">
      <label for="keyword">Keyword</label>
      <input type="text" id="keyword" name="keyword" placeholder="e.g., wallet, backpack" value="<?php echo htmlspecialchars($keyword); ?>" />

      <label for="category">Category</label>
      <select id="category" name="category">
        <option value="">--Select Category--</option>
        <option value="electronics" <?php if ($category == "electronics") echo "selected"; ?>>Electronics</option>
        <option value="documents" <?php if ($category == "documents") echo "selected"; ?>>Documents</option>
        <option value="clothing" <?php if ($category == "clothing") echo "selected"; ?>>Clothing</option>
        <option value="accessories" <?php if ($category == "accessories") echo "selected"; ?>>Accessories</option>
        <option value="others" <?php if ($category == "others") echo "selected"; ?>>Others</option>
      </select>

      <label for="date">Date (optional)</label>
      <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" />

      <button type="submit" class="btn-search">Search</button>
    </form>

    <?php if ($result): ?>
      <?php if ($result->num_rows > 0): ?>
        <h3 style="margin-top:30px; color: #ffa07a;">Search Results:</h3>
        <div class="items-grid">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="item-card">
              <h2><?php echo htmlspecialchars($row['title']); ?></h2>
              <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
              <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
              <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
              <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date_lost']); ?></p>
              <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p style="text-align:center; margin-top: 20px;">No items found matching your criteria.</p>
      <?php endif; ?>
    <?php endif; ?>
  </section>

  <footer class="footer">
    <p>&copy; 2025 Lost & Found | All rights reserved.</p>
  </footer>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>
