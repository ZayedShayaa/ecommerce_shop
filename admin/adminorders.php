<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("../include/connected.php");

$query = $conn->prepare("
    SELECT  
        o.id AS order_id, 
        o.total_price, 
        o.shipping_address, 
        o.city, 
        o.phone_number, 
        o.payment_method, 
        o.credit_card_type, 
        u.username AS name, 
        u.email, 
        u.id AS user_id, 
        o.order_date, 
        o.order_status,  
        GROUP_CONCAT(
            p.proname, ' (', c.quantity, ')'
            SEPARATOR ', '
        ) AS products 
    FROM orders o 
    JOIN user u ON o.user_id = u.id 
    JOIN cart c ON o.id = c.order_id  -- الربط عبر order_id بدلاً من user_id
    JOIN product p ON c.product_id = p.id  
    GROUP BY o.id  -- التجميع بناءً على order_id فقط
    ORDER BY o.order_date DESC   
");

$query->execute();
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلبات</title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من وجود ملف CSS -->
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: right; /* محاذاة النص إلى اليمين */
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: right; /* محاذاة النص إلى اليمين */
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style> 
</head>
<body>
    <div class="container">
        <h2>إدارة الطلبات</h2>
        <table>
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>اسم الزبون</th>
                    <th>البريد الإلكتروني</th>
                    <th>رقم الهاتف</th>
                    <th>المنتجات المطلوبة</th>
                    <th>السعر الإجمالي</th>
                    <th>طريقة الدفع</th>
                    <th>العنوان</th>
                    <th>تاريخ الطلب</th>
                    <th>حالة الطلب</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($orders): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']); ?></td>
                            <td><?= htmlspecialchars($order['name']); ?></td>
                            <td><?= htmlspecialchars($order['email']); ?></td>
                            <td><?= htmlspecialchars($order['phone_number']); ?></td>
                            <td><?= htmlspecialchars($order['products']); ?></td>
                            <td><?= htmlspecialchars($order['total_price']) . " JOD"; ?></td>
                            <td><?= htmlspecialchars($order['payment_method']); ?></td>
                            <td><?= htmlspecialchars($order['shipping_address']) . ", " . htmlspecialchars($order['city']); ?></td>
                            <td><?= htmlspecialchars($order['order_date']); ?></td>
                            <td><?= htmlspecialchars($order['order_status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">لا توجد طلبات حالياً.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>