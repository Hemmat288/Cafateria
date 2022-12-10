<?php

if(isset($_REQUEST['dataproductEdit'])){
    $product=json_decode($_REQUEST['dataproductEdit']);
}

//  echo "<pre>";
//  var_dump($product);
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

 <h1>hk</h1>
 <form method="get" action="coffeeController.php">
        <input type="hidden" value="<?= $product['id'] ?>" name="id">
        
        <input type="text" value="<?= $product['title'] ?>" name="title">
             <?php if(isset($error["title"])){
           echo $error["title"];
         } ?>
        <br>
        <input type="number" value="<?= $product['price'] ?>" name="price">
              <?php if(isset($error["price"])){
           echo $error["price"];
         } ?>
        <br>
        <input type="text" value="<?= $product['image'] ?>" name="image" id="">
             <?php if(isset($error["image"])){
           echo $error["image"];
         } ?>
        <br>
         
        <input type="submit" value="update student" name="update">
    </form>
</body>
</html>

