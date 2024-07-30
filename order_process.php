<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $cart = json_decode($_POST['cartData'], true);  // Correct key used here

    $sql = "INSERT INTO orders (name, email, address) VALUES ('$name', '$email', '$address')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        foreach ($cart as $item) {
            $item_name = $item['name'];
            $item_price = $item['price'];
            $sql = "INSERT INTO order_item (order_id, item_name, total_bill) VALUES ('$order_id', '$item_name', '$item_price')";
            $conn->query($sql);
        }

        echo "Order placed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}

?>
