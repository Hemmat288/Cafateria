<?php
//      if($_COOKIE["fname"]){
//         echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
//  }
//   else{
//       header("location:login.php");
//   }


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
              <a class="nav-link" href="addorder.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AllProduct.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AllUser.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="Allorder.php">Manual Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Checks</a>
            </li>
          </ul>

          <div>
           <!-- <img src="" width="50" height="50"> -->
           <p class="adminAll">  <?php echo"$_COOKIE[name]"?></p>
          </div>

        </div>
      </nav>

<!-- ///////////////////////////////////////body -->
<div class="back">
<div class="allorders">
     <h2 class="linkAddorder"><a href="addorder.php">Add Order</a></h2> 
      <table class="table table-striped">
  <thead>
    <tr>
        <th scope="col">total_price</th>
        <th scope="col"> name</th>
        <th scope="col"> Ext</th>
        <th scope="col">n.Room</th>
        <th scope="col"> status</th>
        <th scope="col">title</th>
        <th scope="col">price</th>
        <th scope="col">image</th>
    </tr>
  </thead>
  <tbody>
  <?php

try {
$data=$db->details("orders.total_price,user.name,user.ext,user.room_number,orders.status,product.title,product.price,product.image","orders","order_details","user","product","orders.id=order_details.order_id AND user.id=orders.user_id AND order_details.product_id=product.id");

  while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    foreach ($row as $value) {
      echo "<td> $value </td>";
    }
    // echo "<td><a href='coffeeController.php?id={$row['id']}&show'>show</a></td>";
    // echo "<td><a href='coffeeController.php?id={$row['id']}&edit'>edit</a></td>";
    // echo "<td><a href='coffeeController.php?id={$row['id']}&delete'>delete</a></td>";
    echo  "</tr>";
  }
} catch (PDOException $e) {
  echo "error catch";
}

$pdo = null;
?>
  </tbody>
</table>
</div>
</div>
</body>

</html>


 