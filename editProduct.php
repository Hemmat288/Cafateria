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

 <form method="post" action="coffeeController.php">
        <input type="hidden" value="<?php echo $product->id ?>" name="id">
        
        <input type="text" value="<?php echo $product->title ?>" name="title">
    
        <br>
        <input type="number" value="<?php echo $product->price ?>" name="price">
        <br>
        <input name="img" type="file"    value="<?php echo $product->image ?>" ><br>
        <br>
        <input type="submit" value="update" name="updateproduct">
    </form>
</body>
</html>

