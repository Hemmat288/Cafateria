<?php

if(isset($_REQUEST['userEditData'])){
    $data=json_decode($_REQUEST['userEditData']);
}

 echo "<pre>";
 var_dump($data);
 echo $data->name."<br>";
 echo $data->room_number."<br>";
 echo $data->ext."<br>";
 echo $data->password."<br>";
 echo $data->image."<br>";
 echo "</pre>" ;
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

            <form action="coffeeController.php" method="post" enctype="multipart/form-data">
            <input type="text"    value="<?php $data['name'] ?>" name="name"><br>
            <?php if(isset($error["name"])){
           echo $error["name"];
         } ?>
            <input type="email"   value="<?php  $data['email'] ?>" name="email"><br>
            <input type="number"  value="<?php  $data['room_number'] ?>" name="room_number"><br>
            <input type="number"   value="<?php $data['ext'] ?>" name="ext"><br>
            <input type="password" value="<?php $data['password'] ?>" name="password"><br>
            <input name="img"     value="<?php  $data['image'] ?>" type="file"><br>

          <input type="submit" name="updateUser" class="usersubmitbtn">
    
        </form>
 
</body>
</html>

