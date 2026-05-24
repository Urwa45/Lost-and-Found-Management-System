<!-- 3. admin-dashboard.html -->
 <?php
session_start();

// Only allow admins
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>
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
        max-width: 900px;
        margin: auto;
      }
      .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
      }
      .card {
        background: rgba(20, 20, 20, 0.85);
        border-radius: 15px;
        box-shadow: 0 0 20px #ff4500cc;
        padding: 25px 20px;
        text-align: center;
        color: #ff4500;
        font-weight: 600;
        letter-spacing: 0.05em;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
      }
      .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 0 35px #ff6347cc;
      }
      .card h2 {
        margin-bottom: 15px;
        font-size: 1.6rem;
        text-shadow: 1px 1px 3px black;
      }
      .card p {
        font-size: 1rem;
        margin-bottom: 20px;
        color: #ffa07a;
      }
      .card a.btn {
        background: #ff4500;
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 0 15px #ff4500cc;
        transition: background-color 0.3s ease;
        display: inline-block;
      }
      .card a.btn:hover {
        background: #ff6347;
        box-shadow: 0 0 25px #ff6347cc;
      }
      footer.footer {
        margin-top: 40px;
        text-align: center;
        color: #ff4500;
        text-shadow: 1px 1px 3px black;
        font-weight: 600;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?> (Admin)</h1>

        <nav class="nav">
          <a href="index.php" class="btn">Home</a>
          <a href="Logout.php" class="btn">Logout</a>

        </nav>
      </div>
    </header>

    <main class="container">
      <div class="dashboard-grid">
        
        <div class="card">
          <h2>📋 Review Reports</h2>
          <p>Check all lost and found item reports submitted by users.</p>
          <a href="8-view_item.php" class="btn">View Reports</a>
        </div>
        <div class="card">
          <h2>➕ Add Items</h2>
          <p>Manually add lost or found items to the system.</p>
          <a href="7-add_item.php" class="btn">Add Item</a>
        </div>
        <div class="card">
          <h2>✏️ Update Items</h2>
          <p>Edit existing item details and status.</p>
          <a href="update-item.php" class="btn">Update Items</a>
        </div>
        <div class="card">
          <h2>🗑️ Delete Items</h2>
          <p>Remove invalid or resolved reports from the system.</p>
          <a href="delete-item.php" class="btn">Delete Items</a>
        </div>
        <div class="card">
          <h2>🔍 Search</h2>
          <p>Search for the Items.</p>
          <a href="search-items.php" class="btn">Search</a>
        </div>
      </div>
    </main>

    <footer class="footer">
      <p>&copy; 2025 Lost & Found | Admin Dashboard</p>
     
    </footer>
  </body>
</html>
