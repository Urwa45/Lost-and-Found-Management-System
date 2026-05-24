<!-- 4. user-dashboard.html -->
<?php
session_start();

// Restrict access to logged-in users only
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: Login.php"); // redirect to login if not user
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <link rel="stylesheet" href="styles.css" />
  <script src="script.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #000;
      font-family: 'Inter', sans-serif;
      color: #ff4500;
    }

    .header {
      background-color: #111;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 0 10px #ff4500aa;
    }

    .header h1 {
      margin: 0;
      font-size: 2.5rem;
      color: #ff4500;
      text-shadow: 1px 1px 4px #000;
    }

    .nav {
      margin-top: 10px;
    }

    .nav a.btn {
      background-color: #ff4500;
      color: #fff;
      padding: 10px 20px;
      margin: 0 8px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 0 10px #ff4500aa;
      transition: background 0.3s;
    }

    .nav a.btn:hover {
      background-color: #ff6347;
      box-shadow: 0 0 15px #ff6347cc;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background-color: #111;
      border-radius: 10px;
      box-shadow: 0 0 20px #ff4500aa;
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
    }

    .card {
      background-color: #090909;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 15px #ff4500cc;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      color: #ff4500;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 0 25px #ff6347cc;
    }

    .card h2 {
      margin-bottom: 10px;
      font-size: 1.5rem;
    }

    .card p {
      color: #ffa07a;
      font-size: 1rem;
      margin-bottom: 15px;
    }

    .card a.btn {
      background-color: #ff4500;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      box-shadow: 0 0 10px #ff4500cc;
    }

    .card a.btn:hover {
      background-color: #ff6347;
      box-shadow: 0 0 20px #ff6347cc;
    }

    footer.footer {
      text-align: center;
      padding: 20px;
      color: #ff4500;
      text-shadow: 1px 1px 3px black;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <header class="header">
    <h1>Welcome, <?php echo $_SESSION['username']; ?> (User)</h1>

    <nav class="nav">
      <a href="index.php" class="btn">Home</a>
      <a href="user-profile.php" class="btn">Profile</a>
     <a href="Logout.php" class="btn">Logout</a>

    </nav>
  </header>

  <main class="container">
    <div class="dashboard-grid">
      <div class="card">
        <h2>👤 Profile</h2>
        <p>Manage your personal information.</p>
        <a href="user-profile.php" class="btn">View Profile</a>
      </div>
      <div class="card">
        <h2>➕ Report Lost Item</h2>
        <p>Submit details about a lost item.</p>
        <?php echo '<a href="7-add_item.php" class="btn">Add Lost Item</a>'; ?>

      </div>
      <div class="card">
        <h2>🔍 View Found Items</h2>
        <p>Browse items that have been found or reported.</p>
       <?php echo '<a href="8-view_item.php" class="btn">View Found Items</a>'; ?>

      </div>
      <div class="card">
        <h2>🔍 Search Item</h2>
        <p>Search for any item.</p>
        <?php echo '<a href="search-items.php" class="btn">Search Item</a>'; ?>

      </div>
      <div class="card">
        <h2>✏️ Update Items</h2>
        <p>Edit existing item details and status.</p>
        <a href="update-item.php" class="btn">Update Items</a>
      </div>
      <div class="card">
        <h2>🗑️ Delete Items</h2>
        <p>Remove invalid or resolved reports from the system.</p>
        <?php echo '<a href="delete-item.php" class="btn">Delete Items</a>'; ?>

      </div>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Lost & Found | User Dashboard</p>
  </footer>
</body>
</html>
