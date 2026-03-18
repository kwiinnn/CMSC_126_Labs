<!DOCTYPE html>
<html>

<head>
  <title>CRUD Menu</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: #000000;
      color: #f5f5f7;
      -webkit-font-smoothing: antialiased;
    }

    .topbar {
      background-color: rgba(28, 28, 30, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      color: #f5f5f7;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #38383a;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .topbar h2 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
      letter-spacing: -0.5px;
    }

    .hamburger {
      font-size: 24px;
      cursor: pointer;
      margin-right: 15px;
      color: #0a84ff;
    }

    .sidebar {
      position: fixed;
      left: -220px;
      top: 0;
      width: 200px;
      height: 100%;
      background-color: #1c1c1e;
      padding-top: 70px;
      border-right: 1px solid #38383a;
      transition: left 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      z-index: 50;
    }

    .sidebar a {
      display: block;
      color: #f5f5f7;
      padding: 12px 20px;
      margin: 4px 10px;
      text-decoration: none;
      border-radius: 8px;
      font-size: 15px;
      transition: background-color 0.2s;
    }

    .sidebar a:hover {
      background-color: #2c2c2e;
    }

    .sidebar.active {
      left: 0;
    }

    .content {
      padding: 30px 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .section {
      background-color: #1c1c1e;
      padding: 30px;
      border-radius: 14px;
      border: 1px solid #38383a;
      overflow-x: auto;
    }

    h3 {
      margin-top: 0;
      font-weight: 600;
      letter-spacing: -0.5px;
    }

    /* Apple-style Inputs */
    input {
      width: 100%;
      padding: 12px 15px;
      margin: 8px 0 16px 0;
      box-sizing: border-box;
      background-color: #2c2c2e;
      color: #f5f5f7;
      border: 1px solid #38383a;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.2s ease;
    }

    input:focus {
      outline: none;
      border-color: #0a84ff;
      background-color: #1c1c1e;
    }

    input::placeholder {
      color: #86868b;
    }

    /* Apple-style Buttons */
    button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      box-sizing: border-box;
      background-color: #0a84ff;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    button:hover {
      background-color: #0071e3;
    }

    /* Minimalist Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      font-size: 14px;
    }

    th, td {
      border-bottom: 1px solid #38383a;
      padding: 12px 10px;
      text-align: left;
    }

    th {
      color: #86868b;
      font-weight: 500;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    hr {
      border: 0;
      height: 1px;
      background: #38383a;
      margin: 30px 0;
    }

    /* Alert Messages */
    .alert-success {
      color: #34c759;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #34c759;
      border-radius: 10px;
      background: rgba(52, 199, 89, 0.1);
    }

    .alert-error {
      color: #ff3b30;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ff3b30;
      border-radius: 10px;
      background: rgba(255, 59, 48, 0.1);
    }
  </style>
</head>

<body>

  <div class="topbar">
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <h2>Smartphone CRUD System</h2>
  </div>

  <div class="sidebar" id="sidebar">
    <a href="?action=read">Read Records</a>
    <a href="?action=insert">Insert Record</a>
    <a href="?action=update">Update Record</a>
    <a href="?action=delete">Delete Record</a>
    <a href="?action=exit">Exit</a>
  </div>

  <div class="content">
    <div class="section">

      <?php

      $action = $_GET['action'] ?? '';


      function connectDB()
      {
        $conn = mysqli_connect("localhost", "root", "", "smartphones_db");
        if (!$conn) {
          die("Database connection failed: " . mysqli_connect_error());
        }
        return $conn;
      }

      function showTable($conn)
      {
        $result = mysqli_query($conn, "SELECT * FROM smartphones");

        if (mysqli_num_rows($result) > 0) {
          echo "<table>";
          echo "<tr>
                <th>ID</th><th>Brand</th><th>Model</th>
                <th>Color</th><th>RAM</th><th>Storage</th>
                <th>Price</th><th>Qty</th>
              </tr>";

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['phone_id']}</td>";
            echo "<td>{$row['brand']}</td>";
            echo "<td>{$row['model_name']}</td>";
            echo "<td>{$row['color']}</td>";
            echo "<td>{$row['ram_gb']} GB</td>";
            echo "<td>{$row['storage_gb']} GB</td>";
            echo "<td>₱" . number_format($row['price'], 2) . "</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "<p style='color: #86868b;'>No records found.</p>";
        }
      }

      function insertRecord($conn)
      {
        if (isset($_GET['submit_insert'])) {
          mysqli_query($conn, "INSERT INTO smartphones
            (brand, model_name, color, ram_gb, storage_gb, price, quantity)
            VALUES (
                '{$_GET['brand']}',
                '{$_GET['model_name']}',
                '{$_GET['color']}',
                '{$_GET['ram_gb']}',
                '{$_GET['storage_gb']}',
                '{$_GET['price']}',
                '{$_GET['quantity']}'
            )");
            
          echo "<div class='alert-success'>Record successfully added!</div>";
        }
      }

      function updateRecord($conn)
      {
        if (isset($_GET['submit_update'])) {
          $phone_id = $_GET['phone_id'];

          $check_query = mysqli_query($conn, "SELECT phone_id FROM smartphones WHERE phone_id = '$phone_id'");

          if (mysqli_num_rows($check_query) > 0) {
            
            if (!empty($_GET['brand']) && !empty($_GET['model_name']) && !empty($_GET['color']) && 
                $_GET['ram_gb'] !== '' && $_GET['storage_gb'] !== '' && 
                $_GET['price'] !== '' && $_GET['quantity'] !== '') {

                mysqli_query($conn, "UPDATE smartphones SET
                  brand='{$_GET['brand']}',
                  model_name='{$_GET['model_name']}',
                  color='{$_GET['color']}',
                  ram_gb='{$_GET['ram_gb']}',
                  storage_gb='{$_GET['storage_gb']}',
                  price='{$_GET['price']}',
                  quantity='{$_GET['quantity']}'
                  WHERE phone_id='$phone_id'");

                echo "<div class='alert-success'>Record successfully updated!</div>";
                
            } else {
                echo "<div class='alert-error'>Error: All fields must be filled out.</div>";
            }

          } else {
            echo "<div class='alert-error'>Error: Phone ID {$phone_id} does not exist. Please check the table below and try again.</div>";
          }
        }
      }

      function deleteRecord($conn)
      {
        if (isset($_GET['submit_delete'])) {
          $phone_id = $_GET['phone_id'];
          
          // Check if the ID exists before deleting
          $check_query = mysqli_query($conn, "SELECT phone_id FROM smartphones WHERE phone_id = '$phone_id'");

          if (mysqli_num_rows($check_query) > 0) {
            mysqli_query($conn, "DELETE FROM smartphones WHERE phone_id='$phone_id'");
            echo "<div class='alert-success'>Record successfully deleted!</div>";
          } else {
            echo "<div class='alert-error'>Error: Phone ID {$phone_id} does not exist.</div>";
          }
        }
      }
      $conn = connectDB();

      insertRecord($conn);
      updateRecord($conn);
      deleteRecord($conn);

      if ($action == "read") {

        echo "<h3>All Records</h3>";
        showTable($conn);

      } else if ($action == "insert") {

        echo "<h3>Insert Record</h3>";

        echo '
        <form method="GET">
        <input type="hidden" name="action" value="insert">

        <input name="brand" placeholder="Brand" required>
        <input name="model_name" placeholder="Model Name" required>
        <input name="color" placeholder="Color" required>
        <input type="number" name="ram_gb" placeholder="RAM (GB)" required>
        <input type="number" name="storage_gb" placeholder="Storage (GB)" required>
        <input type="number" step="0.01" name="price" placeholder="Price (₱)" required>
        <input type="number" name="quantity" placeholder="Quantity" required>

        <button name="submit_insert">Insert</button>
        </form>
        ';

        echo "<hr><h3>Current Records</h3>";
        showTable($conn);

      } else if ($action == "update") {

        echo "<h3>Update Record</h3>";

        echo '
        <form method="GET">
        <input type="hidden" name="action" value="update">

        <input type="number" name="phone_id" placeholder="Phone ID (Must exist in table)" required>
        <input name="brand" placeholder="Brand" required>
        <input name="model_name" placeholder="Model Name" required>
        <input name="color" placeholder="Color" required>
        <input type="number" name="ram_gb" placeholder="RAM (GB)" required>
        <input type="number" name="storage_gb" placeholder="Storage (GB)" required>
        <input type="number" step="0.01" name="price" placeholder="Price (₱)" required>
        <input type="number" name="quantity" placeholder="Quantity" required>

        <button name="submit_update">Update</button>
        </form>
        ';

        echo "<hr><h3>Current Records</h3>";
        showTable($conn);

      } else if ($action == "delete") {

        echo "<h3>Delete Record</h3>";

        echo '
        <form method="GET">
        <input type="hidden" name="action" value="delete">

        <input type="number" name="phone_id" placeholder="Phone ID" required>
        <button name="submit_delete" style="background-color: #ff3b30;">Delete</button>
        </form>
        ';

        echo "<hr><h3>Current Records</h3>";
        showTable($conn);

      } else if ($action == "exit") {

        echo "<h3>Disconnected from system.</h3>";

      } else {

        echo "<h3>Welcome</h3>";
        echo "<p style='color: #86868b;'>Select an option from the menu to manage the smartphone database.</p>";

      }

      ?>

    </div>
  </div>

  <script>
    function toggleMenu() {
      document.getElementById("sidebar").classList.toggle("active");
    }
  </script>

</body>

</html>