<?php
session_start();
include("./include/connected.php");

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

if (!isset($_SESSION['user_id'])) {
    header("Location: ./user/login.php"); 
    exit();
} else {
    $user_id = $_SESSION['user_id'];

    if (isset($product_id)) {
     
        $check = "SELECT * FROM cart WHERE product_id = ? AND user_id = ?";
        $stmt = $conn->prepare($check);
        $stmt->execute([$product_id, $user_id]);

        if ($stmt->rowCount() > 0) {
     
            $update = "UPDATE cart SET quantity = quantity + ? WHERE product_id = ? AND user_id = ?";
            $stmt = $conn->prepare($update);
            $stmt->execute([$quantity, $product_id, $user_id]);
        } else {
         
            $insert = $conn->prepare("INSERT INTO cart(user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insert->execute([$user_id, $product_id, $quantity]);
            echo "done";
        }

        $previous_page = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header("Location: $previous_page");
        exit();
    }
}
?>
