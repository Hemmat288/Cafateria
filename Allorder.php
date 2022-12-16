<?php
session_start();
if ($_SESSION["name"]) {

 require("orders.php");
 require("user.php");
require("product.php");
require("db.php");


$db = new db();
$connection = $db->get_connection();
$product = new product();
$orders = new orders();
$user = new user();
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>

<body>
<nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#">Cafateria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="addorder.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AllProduct.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AllUser.php">Users</a>
            </li>
            <li class="nav-item">
          <a class="nav-link " href="Allorder.php">All Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="myorder.php">My Orders</a>
        </li> 
            <li class="nav-item">
              <a class="nav-link" href="checks.php">Checks</a>
            </li>
          </ul>

        </div>
        <div class="admin" style="display: flex;margin-right:3%;">
     
        <img style="border-radius: 50%;" src="coffee/<?php echo "$_SESSION[src]" ?>" width="40" height="40">
           <p style="margin-left:5%; padding-top:7%"> <?php echo "$_SESSION[name]" ?></p>
           <a style="margin-left:17%; padding-top:7%; color:#F0CAA3 ;" href="logout.php" name="logout">logout</a>
        </div>
      </nav>

<!-- ///////////////////////////////////////body -->

<div class="allorders">
     <h2 class="linkAddorder"><a href="addorder.php">Add Order</a></h2> 

     <?php
$id="";
$name="";
$orderDate;
$counter=0;
$data=$db->details("orders.date,order_details.order_id,orders.total_price,user.name,user.ext,user.room_number,orders.status,product.title,order_details.price,product.image,order_details.qty","orders","order_details","user","product","orders.id=order_details.order_id AND user.id=orders.user_id AND order_details.product_id=product.id");

 foreach ($data as $k=>$row) {
  if($id==$row['order_id'] && $row['name']==$name && $row['date']==$orderDate){
    ?>

    <div style="float:left; width:25%; margin-top:1%; text-align:center; ">
    <div  class="position-relative">
    <img width="100" height="90" style="border-radius:10%" src="coffee/<?php echo $row['image']?>">
  <span style="background:#986644 !important;" class="position-absolute top-20 start-60 translate-middle p-2   badge rounded-pill bg-dark border border-light ">
  <?php echo $row['price']?>LE </span>
</div>
     <p class="p_detailsOrder"><?php echo$row['qty']."  " . $row['title']?></p>

    </div>
  <?php

  }
  else{

    $name=$row['name'];
    $orderDate=$row['date'];
    $id=$row['order_id'];
    if($counter>0){
      ?>
      <div style="float:right;width:100%;padding-left:85%;color:#5C3D2E;">
        <h6><?php echo "total price = ".$total_price?> LE </h6>
      </div>
      <?php
    }
    $counter++;
    $total_price=$row['total_price'];
    ?>
      <table class="table table-striped">
  <thead>
    <tr>
        <th scope="col">order Date</th>
        <th scope="col"> name</th>
        <th scope="col"> Ext</th>
        <th scope="col">Room</th>
        <th scope="col"> status</th>
    </tr>
  </thead>
  <tbody>
  <tr>
<?php
     echo "<td>$row[date]</td>";
     echo "<td>$row[name]</td>";
     echo "<td>$row[ext]</td>";
     echo "<td>$row[room_number]</td>";
     echo "<td>$row[status]</td>";
?>

 </tr>
  </tbody>
      </table>
 

<div style="float:left; width:25%; margin-top:1%;">
    <div  class="position-relative">
    <img width="100" height="90"style="border-radius:10%
    " src="coffee/<?php echo $row['image']?>">
  <span style="background:#986644 !important;" 
  class="position-absolute top-20 start-60 translate-middle p-2  badge rounded-pill  border border-light ">
  <?php echo $row['price']?>LE </span>
</div>
     <p class="p_detailsOrder"><?php echo$row['qty']."  " . $row['title']?></p>
    </div>

  <?php
  }
  
}
if(isset($total_price)){
 ?>
 
 <div style="float:right;width:100%;padding-left:85%;color:#5C3D2E;">
        <h6><?php echo "total price = ".$total_price?> LE </h6>
      </div>
   
</div>
<?php
}
?>

</body>

</html>

<?php

    
} else {
  header("location:login.php");
}

?>