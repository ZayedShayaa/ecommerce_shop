<?php
include("../include/connected.php");
?>
<?php
// select start
@$id=$_GET['id'];
if(isset($_GET['id'])){
    $query="SELECT *FROM product WHERE id='$id'";
    $result=$conn->prepare($query);
    $result->execute();
    if($result){
        $row=$result->fetch(PDO::FETCH_ASSOC);
        
    }
}
if(isset($_POST['update_pro'])){
    if(isset($_GET['id_new'])){


 @$proname=$_POST['proname'];
@$proprice=$_POST['proprice'];
@$prosection=$_POST['prosection'];
@$prodescription=$_POST['prodescription'];
@$prosize=$_POST['prosize'];
@$prounv=$_POST['prounv'];
@$proadd=$_POST['proadd'];
@$id_new=$_GET['id_new'];

// img start
@$imageName=$_FILES['proimg']['name'];
@$imgeTmp=$_FILES['proimg']['tmp_name'];
//img end
if(empty($prodescription)){
    echo '<script> alert("الرجاء اضافه تفاصيل للمنتج")</script>';
}
else{
    @$proimg=rand(0,5000)."_".$imageName;
    move_uploaded_file($imgeTmp, "../uploade/img//". $proimg);
       
    $query="UPDATE product SET 
    proname='$proname',
    proimg='$proimg',
    proprice='$proprice',
    prosection='$prosection',
    prodescription='$prodescription',
    prosize='$prosize',
    prounv='$prounv'
    WHERE id='$id_new'";
    $result=$conn->prepare($query);
    $result->execute();
    if(isset($result)){
        echo '<script>alert("تم تحديث المنتج بناح")</script>';
        header("location:../index.php");
    }
    else{   
        echo '<script>alert("فشل في تحديث المنتج ")</script>';

    }
}
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتجات</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <main>
            <div class="form_product">
                <h1>اضافة منتج</h1>
                <form action="update.php?id_new=<?php echo $row['id'] ;?>" method="post" enctype="multipart/form-data">
                    <label for="name">عنوان المنتج</label>
                    <input type="text" name="proname" id="name"
                     value="<?php echo $row['proname']; ?>">
                    
                    <label for="picture">صوره المنتج</label>
                    <input type="file" name="proimg" id="picture" 
                     value="<?php echo $row['proimg']; ?>">

                    <label for="price">سعر المنتج</label>
                    <input type="text" name="proprice" id="price"
                    value="<?php echo $row['proprice']; ?>">

                    <label for="description">تفاصيل المنتج</label>
                    <input type="text" name="prodescription" id="description"
                    value="<?php echo $row['prodescription']; ?>">

                    <label for="size"> الاحجام المتوفره</label>
                    <input type="text" name="prosize" id="size"
                    value="<?php echo $row['prosize']; ?>">

                    <label for="unv">توفر المنتج</label>
                    <input type="text" name="prounv" id="unv"
                    value="<?php echo $row['prounv']; ?>">
                <!-- start section -->
                    <div>
                    <label for="form_control">  الاقسام</label>
                    <select name="prosection" id="form_control"
                    value="<?php echo $row['prosection']; ?>">
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
                 <input class="button" type="submit"name="update_pro" value="UPDATE">   </input>
                </form>
            </div>
        </main>
    </center>
</body>
</html>