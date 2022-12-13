<?php
session_start();
if ($_SESSION["name"]) {
require("product.php");
require("db.php");


$db = new db();
$connection = $db->get_connection();
$product = new product();


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


        </div>
        <div class="admin" style="display: flex;margin-right:3%;">
     
        <img style="border-radius: 50%;" src="coffee/<?php echo "$_SESSION[src]" ?>" width="40" height="40">
            <p style="margin-left:5%; padding-top:7%"> <?php echo "$_SESSION[name]" ?></p>
            <a style="margin-left:17%; padding-top:7%; color:#F0CAA3 ;" href="logout.php" name="logout">logout</a>
   </div>
      </nav>

<!-- ///////////////////////////////////////body -->
<div class="back">
  <div class="Allproducts">
    <h2 class="linkAddproduct">  <a href="addproduct.php">Add Product</a></h2>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">image</th>
        <th scope="col">price</th>
    </tr>
  </thead>
  <tbody>
  <?php

try {


  $data = $db->show("*", "product");
  while ($row = $data->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    foreach ($row as$key => $value ) {
      if($key!='is_available'){
        echo "<td> $value </td>";
    }
    }
    echo "<td><a href='coffeeController.php?id={$row['id']}&editproduct'>edit</a></td>";
    echo "<td><a href='coffeeController.php?id={$row['id']}&delete'>delete</a></td>";
    echo  "</tr>";
  }
} catch (PDOException $e) {
  echo "error";
}

$pdo = null;
?>

  </tbody>
</table>
    </div>
    </div>
</body>

</html>
<?php
} else {
  header("location:login.php");
}

?>