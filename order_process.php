<?php
include 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode(file_get_contents('php://input'), true);

    if (!empty($cart)) {
        foreach ($cart as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];

            $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                echo "Order for " . $product['name'] . " (Quantity: $quantity) - $" . ($product['price'] * $quantity) . "<br>";
            } else {
                echo "Product with ID $productId not found.<br>";
            }

            $stmt->close();
        }
    } else {
        echo "Cart is empty.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
