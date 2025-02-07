<?=include("file/header.php");?>
   

   <link rel="stylesheet" href="stylepro.css?v=<?php echo time(); ?>">

<main>
    <?php 
    $query="SELECT * FROM product";
    $result=$conn->query($query);
    $result->execute();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        
    
    ?>
    <div class="product">
        <!-- img -->
        <div class="product_img" ><a href="detalis.php?id=<?php echo $row['id'];?>">
            <img src="uploade/img//<?php echo $row['proimg'] ;?>">
            <span class="unvailable"><?php echo $row['prounv']; ?> </span>
            <a href=""></a>
        </div>
        <!-- section -->
        <div class="product_section"><a href="detalis.php?id=<?php echo $row['id'];?>"><?php echo $row['prosection'] ;?></a>
        </div>
        <!-- name -->
        <div class="product_name">
            <a href="detalis.php?id=<?php echo $row['id'];?>"><?php echo $row['proname'] ;?> </a>
        </div>
        <!-- price -->
        <div class="product_price">
            <a href="detalis.php?id=<?php echo $row['id'];?>"><?php echo $row['proprice'] ?>&nbsp;السعر</a>
        </div>
        <!-- description -->
        <div class="product_description">
            <a href="detalis.php?id=<?php echo $row['id'];?>"><i class="fa-solid fa-eye"></i>تفاصيل المنتج :اضغط هنا</a>
        </div>
        <form action="val.php" method="POST">
        <!-- Quantity -->
        <div class="qty_input">
            <button class="qty_count_mins">-</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="7">
            <button class="qty_count_add">+</button>
        </div><br>
         <!-- Quantity -->

        <!-- submit -->
        <div class="submit">
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <button class="add_cart" type="submit" name="add_to_cart">
                <i class="fa-solid fa-cart-plus">&nbsp; &nbsp;</i>أضف الى السلة
            </button>
        </div>
      </form>
             <!-- submit -->
        </div>
<?php
    }
    ?>
    </div>
</main>
<br>
<br>
<br>
<br>
<!-- proudct end -->

<?= include("file/footer.php");?>
