

<?php
ob_start();
session_start();  

if (!isset($_SESSION['user_id'])) {
    header("Location: ./user/login.php"); 
    exit();
}

include("file/header.php");
include("file/footer.php");

 // start delete
 $id=$_GET['id'] ?? null;
 if(isset($id)){
    $query = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $query->execute([$_SESSION['user_id'], $id]);
     if(isset($query)){
        echo '<script>alert("  هل انت متاكد !!!  ")</script>';
     }
    if(!isset($query)){
         echo '<script>alert("لم يتم الحذف هناك خطاء")</script>';
     }
 }
 // end delete

if (isset($_POST['confirm_order'])) {
     echo "<script>alert('تم تأكيد الطلب بنجاح!');</script>";
}

$query = $conn->prepare("SELECT p.*, c.quantity FROM cart c JOIN product p ON c.product_id = p.id WHERE c.user_id = ?");
$query->execute([$_SESSION['user_id']]);
$cart_items = $query->fetchAll(PDO::FETCH_ASSOC);
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin-bottom: 50px;
            margin: 0;
            padding: 20px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: auto;
            overflow-x: hidden;
    
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #f1f1f1;
        }

        .total {
            font-weight: bold;
            color: #007bff;
            
        }
        .divtotal{
            text-align: end;
            display: block;
        }

        .quantity {
            width: 60px;
        }

        .delete-icon {
            color: red;
            cursor: pointer;
        }

        .confirm-button {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin: 20px auto 0;
            width: 150px;
        }

        .confirm-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>سلة التسوق</h1>

        <table>
            <thead>
                <tr>
                    <th>حذف</th>
                    <th>إجمالي السعر</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الاسم </th>
                    <th>صورة المنتج</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                foreach ($cart_items as $item) {
                    $subtotal = $item['proprice'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                        
                    <tr>
                        <td><a href="cart.php?id=<?php echo $item['id'] ;?>"><button type="submit" name="delete" value="" class="delete-icon" style="border:none; background:none;">
                                <i class="fas fa-trash"></i>
                            </button></a> </td>
                        <td class="total"><?php echo number_format($subtotal, 2); ?> &nbsp;</td>
                        <td><input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity" /></td>
                        <td><?php echo $item['proprice']; ?> &nbsp;</td>
                        <td><?php echo $item['proname']; ?></td>
                        <td><img src="uploade/img/<?php echo $item['proimg']; ?>" alt="منتج" width="50"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      <div class="divtotal">  <h3>الإجمالي: <span class="total"><?php echo number_format($total_price, 2); ?> &nbsp;</span></h3>
        <button class="confirm-button" type="submit" name="confirm_order">تأكيد الطلب</button>

    </div>
</body>

</html>