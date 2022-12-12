<?php
    if($_COOKIE["name"]){




// if(isset($_REQUEST['errors'])){
//   $errors=json_decode($_REQUEST['errors']);

// }
 

?>



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

          <div class="admin" style="display: flex;margin-right:3%;">
     
          <img style="border-radius: 50%;" src="coffee/<?php echo "$_COOKIE[src]" ?>" width="40" height="40">
              <p style="margin-left:5%; padding-top:7%"> <?php echo "$_COOKIE[name]" ?></p>
     <p style="margin-left:17%; padding-top:7%">logout</p>
   </div>

        </div>
      </nav>

<!-- ///////////////////////////////////////body -->
<div class="back">
      <div class="adduser">

        <form action="coffeeController.php" method="post" enctype="multipart/form-data">
          <h1 class="p_adduser">Add user</h1>
          <div class="inputAdduser">
            <!------------------------- Name -------------------------->

            <div class="form-group">
              <label> Name 
              <input type="text" name="name">
            </label> <br>
            </div>

            <!------------------------- email -------------------------->

            <div class="form-group">
              <label>Email 
              <input type="email" name="email">
                
              </label>
              <br>
            </div>
  

            <!------------------------- Room -------------------------->

            <div class="form-group">
              <label>Room
              <input type="number" name="room_number">
            </label>
            <br>
            </div>
            <!------------------------- EXT -------------------------->

            <div class="form-group">
              <label>EXT_
              <input type="ext" name="ext">
            </label>
            <br>
            </div>
     
          <!------------------------- password -------------------------->

          <div class="form-group">
            <label>pass
            <input type="password" name="password">
          </label>
          <br>
          </div>
        </div>
          <!------------------------- img -------------------------->

          <div class="form-group Imgadduser">
            <input name="img" type="file"></input>

          </div>
          <!-- <div class="form-group Imgadduser">
            <label for="name" class="form-control-label">الصورة</label>
            <input type="file" class="dropify" name="img" data-default-file="" accept="image/*"/>
            <span class="form-text text-muted text-center">مسموح فقط بالصيغ التالية : jpeg , jpg , png , gif , svg , webp , avif</span>
        </div> -->


          <input type="submit" name="adduser" class="usersubmitbtn"></input>
          <button type="submit" class="submitbtn">reject</button>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


<script>
    $('.dropify').dropify();
</script>

</body>
</html>
<?php
} else {
  header("location:login.php");
}

?>