<?php

$host = 'localhost';    
$db = 'products'; 
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT * FROM tbl_product";
$result = $conn->query($query);


if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
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
            font-family: Arial, sans-serif; 
            font-size: 24px; 
            margin-bottom: 20px;
            font-weight: bold;
        }
        table {
            font-size: 14px;
        }
        th, td {
            padding: 12px;
        }
        th {
            background-color: #EECEB9; 
            color: #1A3636; 
            text-align: center;
        }
        td {
            text-align: center;
        }
        .btn-primary, .btn-custom {
            font-family: Arial, sans-serif;  
            font-size: 14px; 
            padding: 8px 16px;  
            border: none;
        }
        .btn-primary {
            background-color: #F3D0D7;  
            color: #000;  
        }
        .btn-primary:hover {
            background-color: #e0b07e;  
        }
        .btn-warning {
            background-color: #FFBF78;  
            width: 80px; 
            height: 40px;  
            color: #000;  
            margin-right: 5px;  
        }
        .btn-warning:hover {
            background-color: #e0a800;  
        }
        .btn-danger {
            background-color: #EE4E4E; 
            width: 80px; 
            height: 40px;  
            color: #fff;  
        }
        .btn-danger:hover {
            background-color: #c82333;  
        }
        .btn-container {
            display: flex;
            justify-content: center;   
            margin-top: 20px;  
        }
        .action-buttons {
            display: flex;
            justify-content: center;   
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">PRODUCT LIST</h2>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Barcode</th>
                    <th>Created By</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['quantity']) ?></td>
                    <td><?= htmlspecialchars($product['barcode']) ?></td>
                    <td><?= htmlspecialchars($product['created_by']) ?></td>
                    <td><?= htmlspecialchars($product['update_at']) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn btn-warning btn-custom" href="update.php?id=<?= urlencode($product['id']) ?>">Edit</a>
                            <a class="btn btn-danger btn-custom" href="delete.php?id=<?= urlencode($product['id']) ?>">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="btn-container">
            <a class="btn btn-primary btn-custom" href="create.php">Create New Product</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
