<?php
// Database connection using MySQLi
$host = 'localhost';    // Database host
$db = 'products';       // Database name
$user = 'root';         // Database username
$pass = '';             // Database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];
    $created_by = $_POST['created_by'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO tbl_product (name, description, price, quantity, barcode, created_by, update_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");

    // Check if prepare() failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssdiss", $name, $description, $price, $quantity, $barcode, $created_by);

    if ($stmt->execute()) {
        // Redirect to index.php after successful insertion
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #677D6A;
        }
        .container {
            background-color: #ECFFE6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #F3D0D7;
            border: none;
            color: #000;
        }
        .btn-primary:hover {
            background-color: #e0b07e;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Create Product</h2>
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Barcode</label>
                <input type="text" name="barcode" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Created By</label>
                <input type="text" name="created_by" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
