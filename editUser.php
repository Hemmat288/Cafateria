<?php

if(isset($_REQUEST['userEditData'])){
    $data=json_decode($_REQUEST['userEditData']);
}

//  echo "<pre>";
//  var_dump($data);
//  echo $data->id."<br>";
//  echo $data->name."<br>";
//  echo $data->email."<br>";
//  echo $data->room_number."<br>";
//  echo $data->ext."<br>";
//  echo $data->password."<br>";
//  echo $data->image."<br>";
//  echo "</pre>" ;
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
            <input type="hidden" value="<?php  echo $data->id ?>" name="id">
            <input type="text"    value="<?php  echo $data->name?>" name="name"><br>
            <input type="email"   value="<?php  echo $data->email ?>" name="email"><br>
            <input type="number"  value="<?php  echo $data->room_number  ?>" name="room_number"><br>
            <input type="number"   value="<?php echo $data->ext   ?>" name="ext"><br>
            <input type="password" value="<?php echo $data->password  ?>" name="password"><br>
            <input name="img"     value="<?php  echo $data->image   ?>" type="file"><br>

          <input type="submit" name="updateUser" class="usersubmitbtn">
    
        </form>
 
</body>
</html>

