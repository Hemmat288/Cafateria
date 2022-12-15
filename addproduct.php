  
<?php
session_start();
if ($_SESSION["name"]) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <title>add product</title>
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

<div class="back">
<div class="addproduct">
    
<form action="coffeeController.php" method="post" enctype="multipart/form-data" >
<h1 class="p_addproduct">Add Product</h1>
<div class="inputAddproduct">
    <!-------------------------title -------------------------->
    <div class="form-group ">
      <label class="col-sm-2 col-form-label">
        Title
      </label>
      <br>
      <div class="col-sm-10">
        <input type="text" name="title">
      </div>
    </div>
    <!------------------------- price-------------------------->
    <div class="form-group" >
        <label for="exampleInputEmail1">price
      </label>
      <br>
      <div class="col-sm-10">
        <input type="number" name="price">
      </div>
      </div>
      </div>


<!------------------------- img -------------------------->

<div class="form-group" >
     
       
        <div class="col-sm-10  Imgaddprodct">
          <input name="img" type="file" ></input>
        </div>
      </div>


    <input type="submit" name="addproduct" class="submitbtn"></input>
    <button type="submit" class="submitbtn">reject</button>
  </form>
</div>
 </div>
 </div>
  
</body>
</html>


<?php
} else {
  header("location:login.php");
}

?>