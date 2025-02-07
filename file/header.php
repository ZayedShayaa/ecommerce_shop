<?php
include("./include/connected.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>الصفحة الرئيسية</title>
  <!-- <link rel="stylesheet" href="../style.css"> -->
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">


  <!-- start fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- end fontawesome -->
   <!-- <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

header{
    height: 80px;
    width: 100%;
    background-color: #e8eeed;
}
.logo h1{
    float: left;
    padding:0;
    color: black;
    margin-left: 3px;
    font-size: 35px;
    font-weight: 900;
    text-shadow: 3px 3px 3px rgba(253, 6, 6,0.2);
}
.logo img{
width: 50px;
height: 50px;
border-radius: 10px;
float: left;
}
.search{
    float: right;
    margin-right:10px ;
    margin-top: 20px;
}
.search_input{
    padding: 6px;
    color: #080808;
    width: 150px;
    font-size: 16px;
    border: 1px solid #111111;
    margin-top: 5px;
}
.button_search{
    padding: 5px 10px;
    background-color: #0f74f4;
    border-radius: 5px;
    cursor: pointer;
    background-color: #0073ff;
    color: white;
    border: none;
    transition: 0.3s;
    font-size: 16px;
    font-weight: bold;
    margin-top: 10px;
}

.button_search:hover {
    background-color: #011c38;
}
nav{
    width: 100%;
    height: 45px;
    background-color: #f8f7f8;
    border-bottom: 3px solid #dfdadf;
}
.social ul{
    list-style: none;
    margin-left: 20px;
}
.social  li{
    float: left;
    padding: 5px 10px;
    margin-top: 5px;
}
.social a{
    color: rgb(87, 86, 86);

}
.social a:hover{
    color: #86b1e9;
}
.section ul{
    list-style: none;
}
.section li{
    float: right;
    padding: 5px 3px;
    margin-left: 5px;
}
.section a{
    /* delete underline */
    text-decoration: none; 
    font-size: 20px;
    color: black;
    padding: 5px 3px;
    border-radius: 5px;
}
.section a:hover{
    background-color: #f5AA2E;
    color: white;
}
.last-post{
    width: 100%;
    height: 50px;
    background-color: #f8f7f8;
    border-radius: 4px solid white;
}
.last-post h4{
    float: right;
    color: #080808;
    font-size: 20px;
    padding: 5px;
    margin-left: 5px;
}
.last-post ul{
    list-style: none;
    margin: 2px;
    padding: 3px;
}
.last-post .span-img img{
float: right;
width: 30px;
height: 30px;
margin-left: 10px;
border-radius: 15px;
}
.cart ul{
    list-style: none;
    margin: 0;
    padding: 0;
}
.cart li{
    display: inline-block;
    margin-left: 15px;
    padding: 2px;
    font-size: 24px;
}
.cart a{
    color: #080808;
}
.cart a:hover{
    color: rgb(170, 210, 245);
}
.cart-icon{
    /* تغيير مكان العنصر */
    position: relative;
    display: inline-block;
}
.cart-count{
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #ff0000;
    color: #fff;
    padding: 4px 6px;
    border-radius: 50%;
    font-size: 12px;
}


   </style> -->
</head>

<body>
  <header>
    <!-- start logo -->
    <div class="logo">
      <img src="./images/light4.png" width="100">
      <h1>store</h1>
    </div>
    <!-- end logo -->
    <!-- start search -->
    <div class="search">
      <div class="search_bar">
        <form action="search.php" method="get">
          <input type="text" class="search_input" name="search" placeholder="أدخل كلمة البحث">
          <button class="button_search" name="btn-search">بحث</button>
        </form>
      </div>
    </div>
    <!-- end search -->
  </header>
  <!-- start social -->
  <nav>
    <div class="social">
      <ul>
        <li><a href="" target_blanck><i class="fa-brands fa-facebook"></i></a></li>
        <li><a href="https://wa.me/775944740" target_blanck><i class="fa-brands fa-whatsapp"></i></li>
        <li><a href="" target_blanck><i class="fa-brands fa-square-instagram"></a></i></li>
        <li><a href="" target_blanck><i class="fa-brands fa-youtube"></i></a></li>
      </ul>
    </div>
    <!-- end social -->
    <!-- start section -->
    <div class="section">
      <ul>
        <li><a href="index.php">الرئيسية</a></li>

        <?php
        $query = "SELECT * FROM section";
        $result = $conn->prepare($query);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          ?>
        
          <li><a href="section.php?section=<?php echo $row['sectionname']; ?>"> <?php echo $row['sectionname']; ?>
            </a></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </nav>
  <!-- end section -->
  <div class="last-post">
    <h4>مضاف حديثا</h4>
    <ul>
    <?php 
    $query="SELECT * FROM product ORDER BY ID DESC LIMIT 3";
    $result=$conn->query($query);
    $result->execute();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        
    
    ?>
      <li><a href="">
          <span class="span-img"><img src="uploade/img//<?php echo $row['proimg'] ;?>"></span>
        </a></li>
    <?php
    }
    ?>
    </ul>
    <!-- cart start -->
    <div class="cart">
      <ul>
        <li><a href="./user/registers.php"><i class="fa-solid fa-user"></i></a></li>
        <li class="cart-icon"><a href="cart.php"><i class="fas fa-shopping-cart "></i></a>
          <span class="cart-count">1</span>
        </li>
      </ul>
    </div>
    <!-- cart end -->

  </div>