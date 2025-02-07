<?php
session_start();
include("../include/connected.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="../user/style.css">
</head>


<body>
    <main>
        <?php
        @$ADemail = $_POST['email'];
        @$ADpassword = $_POST['password'];
        @$ADadd = $_POST['add'];

        if (isset($ADadd)) {
            if (empty($ADemail) || empty($ADpassword)) {
                echo '<script>alert("الرجاء ادخال كلمة السر والبريد الالكتروني")</script>';
            } else {
                $query = "SELECT* FROM admin WHERE email='$ADemail' AND password='$ADpassword'";
                $result = $conn->prepare($query);
                $result->execute();
                if ($result->rowCount() == 1) {
                    $_SESSION['EMAIL'] = $ADemail;
                    echo '<script>alert(" مرحبا بك ايها المدير سوف يتم تحويلك الى لوحة التحكم")</script>';
                    header("REFRESH:2; URL=adminpanel.php");
                } else {
                    echo '<script>alert(" مرحبا بك ليس مسموح لك دخول لهذه الصفحه سوف يتم تحويلك الى المتجر مباشرة")</script>';
                    header("REFRESH:2; URL=../index.php");
                }
            }

        }
        ?>
        <div class="container">
            <h1>تسجيل الدخول</h1>
            <form action="admin.php" method="post">
                <label for="em">البريد الالكتروني</label>
                <input type="email" name="email" id="em">
                <br>
                <label for="pass">كلمة المرور</label>
                <input type="text" name="password" id="pass">

                <br>
                <button type="submit" name="add">تسجيل الدخول</button>
            </form>
        </div>
    </main>
</body>

</html>