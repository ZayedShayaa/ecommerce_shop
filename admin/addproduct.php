<?php
include("../include/connected.php");
?>
<?php 
// @$variable=value;
@$proname=$_POST['proname'];
@$proprice=$_POST['proprice'];
@$prosection=$_POST['prosection'];
@$prodescription=$_POST['prodescription'];
@$prosize=$_POST['prosize'];
@$prounv=$_POST['prounv'];
@$proadd=$_POST['proadd'];

// img start
@$imageName=$_FILES['proimg']['name'];
@$imgeTmp=$_FILES['proimg']['tmp_name'];
//img end
if(isset($proadd)){
    if(empty($proname)||empty( $proprice)||empty( $prosection)||empty( $prodescription)||empty( $prosize)){
        echo '<script>alert("الرجاء ملئ جميع الحقول");</script>';
    }
    else{
        $proimg=rand(0,5000)."_".$imageName;
        if(!move_uploaded_file($imgeTmp, "../uploade/img//". $proimg)){
            echo '<script>alert(" في تحميل الصوره فشل ");</script>';
            exit();
        }
        $query="INSERT INTO  product(proname,proimg,proprice,prosection,prodescription,prosize,prounv)
        VALUES('$proname','$proimg','$proprice','$prosection','$prodescription','$prosize','$prounv')";
        $result=$conn->prepare($query);
        $result->execute();
        if(isset($result)){
            echo'<script> alert("تمت اضافة المنشور بنجاح")</script>';
        }
        else{
            echo'<script> alert("لم يتم اضافة المنشور ")</script>';

        }
        
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة منتجات</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <main>
            <div class="form_product">
                <h1>اضافة منتج</h1>
                <form action="addproduct.php" method="post" enctype="multipart/form-data">
                    <label for="name">عنوان المنتج</label>
                    <input type="text" name="proname" id="name">
                    
                    <label for="picture">صوره المنتج</label>
                    <input type="file" name="proimg" id="picture">

                    <label for="price">سعر المنتج</label>
                    <input type="text" name="proprice" id="price">

                    <label for="description">تفاصيل المنتج</label>
                    <input type="text" name="prodescription" id="description">

                    <label for="size"> الاحجام المتوفره</label>
                    <input type="text" name="prosize" id="size">

                    
                <!-- start section -->
                    <div>
                    <label for="form_control">  الاقسام</label>
                    <select name="prosection" id="form_control">
                        <?php 
                        $query= 'SELECT *FROM section';
                        $result=$conn->prepare($query);
                        $result->execute();
                        while($row=$result->fetch(PDO::FETCH_ASSOC)){
                            echo ' <option name="section">'.$row['sectionname'].' </option>';
                        }
                        ?>
                    </select>
                </div><br>
                <!-- end section -->
                 <input class="button" type="submit"name="proadd">   </input>
                </form>
            </div>
        </main>
    </center>
</body>
</html>