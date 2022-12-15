<?php
session_start();
if ($_SESSION["name"]) {
if(isset($_REQUEST['userEditData'])){
    $data=json_decode($_REQUEST['userEditData']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />

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
              <a class="nav-link" href="#">Checks</a>
            </li>
          </ul>

          <div class="admin" style="display: flex;margin-right:3%;">
     
          <img style="border-radius: 50%;" src="coffee/<?php echo "$_SESSION[src]" ?>" width="40" height="40">
              <p style="margin-left:5%; padding-top:7%"> <?php echo "$_SESSION[name]" ?></p>
              <a style="margin-left:17%; padding-top:7%; color:#F0CAA3 ;" href="logout.php" name="logout">logout</a>
   </div>

        </div>
      </nav>
      <!-- ///////////////////////////////////////body -->
<div class="back">
<div class="addproduct">
    
<form action="coffeeController.php" method="post" enctype="multipart/form-data" >
<div class="inputAdduser">
<input type="hidden" value="<?php  echo $data->id ?>" name="id">
 
            <!------------------------- Name -------------------------->

            <div class="form-group">
              <label> Name 
              <input type="text"    value="<?php  echo $data->name?>" name="name"> 
            </label> <br>
            </div>

            <!------------------------- email -------------------------->

            <div class="form-group">
              <label>Email 
              <input type="email"   value="<?php  echo $data->email ?>" name="email">
                
              </label>
              <br>
            </div>
  

            <!------------------------- Room -------------------------->

            <div class="form-group">
              <label>Room
              <input type="number"  value="<?php  echo $data->room_number  ?>" name="room_number">
            </label>
            <br>
            </div>
            <!------------------------- EXT -------------------------->

            <div class="form-group">
              <label>EXT_
              <input type="number"   value="<?php echo $data->ext   ?>" name="ext">
            </label>
            <br>
            </div>
     
          <!------------------------- password -------------------------->

          <div class="form-group">
            <label>pass
            <input type="password" value="<?php echo $data->password  ?>" name="password">
          </label>
          <br>
          </div>
        </div>
          <!------------------------- img -------------------------->

          <div class="form-group Imgadduser">
          <input name="img" value="<?php  echo $data->image ?>" type="file">
          </div>
        <input type="submit"  value="update" name="updateUser" class="usersubmitbtn">
    
        </form>
 </div>
 </div>
  
</body>
</html>

 
 
<?php
} else {
  header("location:login.php");
}

?>

