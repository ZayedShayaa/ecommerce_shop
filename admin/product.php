<?php
include("../include/connected.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المنتجات</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // start delete
    @$id=$_GET['id'];
    if(isset($id)){
        $query="DELETE FROM product WHERE   id='$id'";
        $delete=$conn->prepare($query);
        $delete->execute();
        if(isset($delete)){
            echo '<script>alert("تم الحذف بنجاح")</script>';
        }
        else{
            echo '<script>alert("لم يتم الحذف هناك خطاء")</script>';

        }
    }
    // end delete
    ?>
    <div class="sidebare_container">
        <!-- table start -->
        <table dir="rtl">
            <tr>
                <th>رقم المنتج </th>
                <th>صورة المنتج</th>
                <th>عنوان المنتج </th>
                <th>سعرالمنتج </th>
                <th>الاحجام المتوفرة </th>
                <th>توفر المنتج </th>
                <th> الاقسام </th>
                <th>تفاصيل المنتج </th>
                <th>حذف المنتج </th>
                <th>تعديل المنتج </th>
            </tr>
            <?php
            $query="SELECT *FROM product";
            $result=$conn->prepare($query);
            $result->execute();
            while($row=$result->fetch(PDO::FETCH_ASSOC)){

            
            ?>
            <tr>
                <td><?php echo $row['id'];?> </td>
                <!-- img -->
                <td><img src="../uploade/img//<?php echo $row['proimg'];?>"></td>
                <!-- img -->
                <td><?php echo $row['proname'];?>  </td>
                <td><?php echo $row['proprice'];?>  </td>
                <td><?php echo $row['prosize'];?>  </td>
                <td><?php echo $row['prounv'];?>  </td>
                <td><?php echo $row['prosection'];?>  </td>
                <td><?php echo $row['prodescription'];?>  </td>
                

                <td><a href="product.php?id=<?php echo $row['id'] ;?>"><button type="submit" class="delete">حذف المنتج</button></a></td>
                <td><a href="update.php?id=<?php echo $row['id'] ;?>"><button type="submit" class="update">تعديل المنتج</button></a></td>

            </tr>
            <?php
            }?>
            </table>
    </div>
</body>

</html>