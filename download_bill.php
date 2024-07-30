<?php
include 'db_connect.php';

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM orders WHERE id='$order_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();

    echo "<h1>Order Bill</h1>";
    echo "<p>Order ID: " . $order['id'] . "</p>";
    echo "<p>Name: " . $order['name'] . "</p>";
    echo "<p>Email: " . $order['email'] . "</p>";
    echo "<p>Address: " . $order['address'] . "</p>";
    echo "<p>Order Date: " . $order['order_date'] . "</p>";

    $sql = "SELECT * FROM order_item WHERE order_id='$order_id'";
    $result = $conn->query($sql);
    $total_bill = 0;

    echo "<h2>Items</h2>";
    while ($item = $result->fetch_assoc()) {
        echo "<p>Item Name: " . $item['item_name'] . "</p>";
        echo "<p>Item Price: $" . $item['total_bill'] . "</p>";
        $total_bill += $item['total_bill'];
    }

    echo "<h2>Total Bill: $" . $total_bill . "</h2>";
} else {
    echo "No order found with ID: $order_id";
}

$conn->close();
?>
