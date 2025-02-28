<?php
session_start();
include("../include/connected.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- start fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- end fontawesome -->
    <link rel="stylesheet" href="style.css">
    <title>لوحة التحكم</title>
</head>

<body>
    <?php
    if (!isset($_SESSION["EMAIL"])) {
        header('location:../index.php');
    } else {
        ?>
        <?php
        @$sectionname = $_POST['sectionname'];
        @$secadd = $_POST['secadd'];
        @$id=$_GET['id'];

        if (isset($secadd)) {
            if (empty($sectionname)) {
                echo '<script>alert("الحقل فارغ الرجاء ملئ الحقل")</script>';
            }
             elseif ($sectionname < 50) {
                echo '<script>alert("  اسم القسم طويل جدا")</script>';
            }
            else {
                $query="INSERT INTO section (sectionname)VALUES('$sectionname')";
                $result=$conn->prepare($query);
                $result->execute();
                echo '<script>alert("  تم اضافه القسم بنجاح")</script>';
                
                header("Location: adminpanel.php");
                exit();
            }
        }
        ?>
        <?php
        #delete section
        if(isset($id)){
            $query=" DELETE FROM section WHERE id='$id'" ;
            $delet=$conn->prepare($query);
            $delet->execute();
            if(isset($delet)){
                echo '<script>alert("تم الحذف بنجاح")</script>';
            }
            else {  
                echo '<script>alert(" لم يتم الحذف ")</script>';
            }
        }
        
        ?>
        <!-- side bar start -->
        <div class="sidebare_container">
            <div class="sidebar">
                <h1>لوحة تحكم الادارة</h1>
                <ul>
                    <li><a href="../index.php" target="_blank">الصفحة الرئيسية<i class="fa-solid fa-house"></i></a></li>
                    <li><a href="product.php" target="_blank"> المنتجات<i class="fa-solid fa-shirt"></i></a></li>
                    <li><a href="addproduct.php" target="_blank">اضافة منتج <i class="fa-solid fa-folder-plus"></i></a></li>
                    <li><a href="../index.php" target="_blank">معلومات الاعضاء <i class="fa-solid fa-users"></i></a></li>
                    <li><a href="adminorders.php" target="_blank">طلبات الزبائن <i class="fa-solid fa-folder-open"></i></a>
                    </li>
                    <li><a href="logout.php" target="_blank">تسجيل الخروج <i class="fa-solid fa-right-from-bracket"></i>
                        </a></li>
                </ul>
            </div>

            <!-- sidebar end -->

            <!-- section start -->
            <div class="content_sec">
                <form action="adminpanel.php" method="post">
                    <label for="section">اضافة قسم جديد</label>
                    <input type="text" name="sectionname" id="section">
                    <br>
                    <button class="add" type="submit" name="secadd">اضافة قسم</button>
                </form>
                <br>
                <!-- table start -->
                <table dir="rtl">
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <th>القسم</th>
                        <th>حذف القسم</th>
                    </tr>
                    <tr>
                        <?php
                        $query= 'SELECT*FROM section ';
                        $result=$conn->prepare($query);
                        $result->execute();
                        while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                        
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['sectionname']; ?></td>
                        <td><a href="adminpanel.php?id=<?php echo $row['id'];?>"><button type="submit" class="delete">حذف القسم</button></a></td>
                    </tr>
                    <?php
                        }
                        ?>
                    
                </table>
                <!-- end table -->
            </div>
            <!-- section end -->


        </div>
    <?php
        // close else
    }
    ?>
</body>

</html>