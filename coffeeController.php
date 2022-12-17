    <?php


    require("user.php");
    require("product.php");
    require("orders.php");
    require("order_details.php");
    require("db.php");


    $db = new db();
    $connection = $db->get_connection();
    $user = new user();
    $product = new product();
    $orders = new orders();
    $order_details = new order_details();




    //   ----------------------------login user----------------------------
    if (isset($_POST['login'])) {
      $sudentData = $db->select("*", "user", " email='{$_POST['email']}' and password='{$_POST['password']}'");
 
      $studentinfo = $sudentData->fetch(PDO::FETCH_ASSOC);
      $id = $studentinfo["id"];
      $name = $studentinfo["name"];
      $email = $studentinfo["email"];
      $password = $studentinfo["password"];
      $image = $studentinfo["image"];
      
      echo $email . "  " . $password;
      //////////////// $ sudentData check not work with me
      if ($password != "" && $email != "") {
      session_start();
      $_SESSION['id']= $id;
      $_SESSION['name']= $name;
      $_SESSION['src']= $image;

       header("location:AllUser.php");
      } else {
        header("location:login.php");
      }
    }


    //   ----------------------------add user----------------------------
    if (isset($_REQUEST['adduser'])) {

      try {


        $user->name = $user->validation($_REQUEST['name']);
        $user->email = $user->validation($_REQUEST['email']);
        $user->password = $user->validation($_REQUEST['password']);
        $user->room_number = $user->validation($_REQUEST['room_number']);
        $user->ext = $user->validation($_REQUEST['ext']);
        $user->image = $user->validation($_FILES["img"]["name"]);
        $errors = $user->countError();
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        $allowedExtension = ["png", "jpg", "txt","jfif","jpeg"];

        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";

          header("location:adduser.php?errors=$imgExtension");
        }

        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],"coffee/$_FILES[img][name]")) {
          $errors["img"] = "img is not exists";
        }
        if ($errors > 0) {
          $errorArray = json_encode($student->errors);
          header("location:adduser.php?errorArray=$errorArray");
        } else {
          $name = $user->name;
          $email = $user->email;
          $password = $user->password;
          $image = $user->image;
          $room_number = $user->room_number;
          $ext = $user->ext;

          $db->insert(
            "user",
            "
         name ='$name',
          email='$email',
           password='$password',
           image='$image',
           room_number='$room_number',
           ext='$ext'
           "
          );

          header("location:AllUser.php?name=$name");
        }
      } catch (PDOException $e) {
        echo "error";
      }
    }

    //   ----------------------------delete user----------------------------
    else if (isset($_REQUEST['delete'])) {
      $id = $_REQUEST['id'];

      echo $id;

      try {
        $db->delete("user", "id=$id");
        header("location:AllUser.php");
      } catch (PDOException $e) {
        echo "connection failed";
      }
    }
    //   ----------------------------edit user----------------------------
    elseif (isset($_REQUEST['edituser'])) {


      $id = $_REQUEST['id'];

      try {

        $datadb = $db->select("*", "user", "id=$id");

        $userEditData = json_encode($datadb->fetch(PDO::FETCH_ASSOC));

        header("location:editUser.php?userEditData=$userEditData");
      } catch (PDOException $e) {
        echo "connection failed";
      }
    }

    //   ----------------------------update user----------------------------

    else if (isset($_REQUEST['updateUser'])) {
      try {
        $user->id = $user->validation($_REQUEST['id']);
        $user->name = $user->validation($_REQUEST['name']);
        $user->email = $user->validation($_REQUEST['email']);
        $user->password = $user->validation($_REQUEST['password']);
        $user->room_number = $user->validation($_REQUEST['room_number']);
        $user->ext = $user->validation($_REQUEST['ext']);
        $errors = $user->countError();

  if(isset($_FILES['img'])){
    echo"not empty";
        $user->image = $user->validation($_FILES["img"]["name"]);
    
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        $allowedExtension = ["png", "jpg", "txt","jfif","jpeg"];

        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";

          header("location:adduser.php?errors=$imgExtension");
        }
      
        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],"coffee/$_FILES[img][name]")) {
          $errors["img"] = "img is not exists";
        }
        if ($errors > 0) {
          $errorArray = json_encode($user->errors);
          header("location:editUser.php?errorArray=$errorArray");
        } else {
          $id = $user->id;
          $name = $user->name;
          $email = $user->email;
          $password = $user->password;
          $image = $user->image;
          $room_number = $user->room_number;
          $ext = $user->ext;


          $sudentData = $db->update("user", "
             name ='$name',
             email='$email',
              password='$password',
              image='$image',
              room_number='$room_number',
              ext='$ext'
             ", "id= $id
             ");

          header("location:AllUser.php?length=$er");
        }
      }
      else{
        echo"empty";
        if ($errors > 0) {
          $errorArray = json_encode($user->errors);
          header("location:editUser.php?errorArray=$errorArray");
        } else {
          $id = $user->id;
          $name = $user->name;
          $email = $user->email;
          $password = $user->password;
          $room_number = $user->room_number;
          $ext = $user->ext;


          $sudentData = $db->update("user", "
             name ='$name',
             email='$email',
              password='$password',
              room_number='$room_number',
              ext='$ext'
             ", "id= $id
             ");

          header("location:AllUser.php?length=$er");
        }
      }
      } catch (PDOException $e) {
        echo $e;
      }
    }
    
    //   ----------------------------delete processing order----------------------------
    // deleteOrder
    else if (isset($_REQUEST['deleteOrder'])) {
      $id = $_REQUEST['id'];

      echo $id;

      try {
        $db->delete("orders", "id=$id");
        header("location:myorder.php");
      } catch (PDOException $e) {
        echo "connection failed";
      }
    }
    //   ----------------------------add order----------------------------
    if (isset($_REQUEST['addorder'])) {
      $productid = [];
      $productname = [];
      $productcount = [];
      $pricecountproduct = [];

      foreach ($_REQUEST['productid'] as $k => $v) {
        array_push($productid, $v);
      }
      foreach ($_POST['productname'] as $k => $v) {
        array_push($productname, $v);
      }
      foreach ($_POST['productcount'] as $k => $v) {

        array_push($productcount, (int)$v);
      }
      foreach ($_POST['productprice'] as $k => $v) {
        array_push($pricecountproduct, (float)$v);
      }

      ///////////////////////////////////
      try {
        $orders->total_price = $orders->validation($_REQUEST['total_price']);
        $orders->note = $orders->validation($_REQUEST['note']);
        $orders->user_id = $orders->validation($_REQUEST['selectedUserid']);
if(!$_REQUEST['selectedUserid']){
  header("location:addorder.php");
}else{


        $errors = $orders->countError();
        if ($errors > 0) {
          $errorArray = json_encode($student->errors);
          header("location:login.php?errorArray=$errorArray");
        } else {
          $total_price = $orders->total_price;
          $note = $orders->note;
          $user_id = $orders->user_id;
          echo "hi2";
         /////////add in orders
          $db->insert("orders", "
               total_price ='$total_price',
               note='$note',user_id='$user_id'");
          echo "hi3";
          ////////add in orderDetails
          $order_id = $db->showMix("id", "orders");

          for ($i = 0; $i < count($productcount); $i++) {
            $db->insert("order_details", "order_id='$order_id',product_id='$productid[$i]',qty='$productcount[$i]',price= '$pricecountproduct[$i]'");
          }
          header("location:Allorder.php?total_price=$total_price");
        }
      }
      } catch (PDOException $e) {
        echo "error";
      }
    }
 //   ----------------------------update order status----------------------------

 if (isset($_REQUEST['status'])) {
  $id=$_GET['id'];
$status=$_GET['status'];
echo $id;
echo $status;
 $db->update("orders","status='$status'","id=$id");
 header("location:Allorder.php");
 }

    //   ----------------------------add product----------------------------
    if (isset($_REQUEST['addproduct'])) {

      try {
        $product->title = $product->validation($_REQUEST['title']);
        $product->price = $product->validation($_REQUEST['price']);
        $product->image = $product->validation($_FILES["img"]["name"]);
        $errors = $product->countError();
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);

        $allowedExtension = ["png", "jpg", "txt","jfif","jpeg"];
        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";
          header("location:login.php?errors=$imgExtension");
        }

        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],"coffee/$_FILES[img][name]")) {
          $errors["img"] = "img is not exists";
        }
        if ($errors > 0) {
          $errorArray = json_encode($student->errors);
          header("location:login.php?errorArray=$errorArray");
        } else {
         
          $title = $product->title;
          $price = $product->price;
          $image = $product->image;

          $db->insert(
            "product",
            "
         title ='$title',
          price='$price', 
           image='$image'"
          );

          header("location:ALlProduct.php?title=$title");
        }
      } catch (PDOException $e) {
        echo "error";
      }
    }
    //   ----------------------------delete product----------------------------

    else if (isset($_REQUEST['delete'])) {
      $id = $_REQUEST['id'];

      echo $id;

      try {
        $db->delete("product", "id=$id");
        header("location:AllProduct.php");
      } catch (PDOException $e) {
        echo "connection failed";
      }
    }
    //   ----------------------------edit product----------------------------
    else if (isset($_REQUEST['editproduct'])) {
      $id = $_REQUEST['id'];
      try {
        $sudentData = $db->select("*", "product", "id=$id");

        $productinfo = $sudentData->fetch(PDO::FETCH_ASSOC);
        $dataproductEdit = json_encode($productinfo);
        header("location:editProduct.php?dataproductEdit=$dataproductEdit");
      } catch (PDOException $e) {
        echo $e;
      }
      $connection = null;
    }
    /////////////////updateproduct////////////////////////////////

    else if (isset($_REQUEST['updateproduct'])) {

      try {
        $product->id = $product->validation($_REQUEST['id']);
        $product->title = $product->validation($_REQUEST['title']);
        $product->price = $product->validation($_REQUEST['price']);
        $errors = $product->countError();
        if(isset($_FILES['img'])){
          echo "not empty";
        //   $product->image = $product->validation($_FILES["img"]["name"]);
        //   echo $product->image;
        //   $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        //   $allowedExtension = ["png", "jpg", "txt","jfif","jpeg"];
        //   if (!in_array($imgExtension, $allowedExtension)) {
        //     $errors["imgExtension"] = "not in allow imgExtension";
        //     header("location:login.php?errors=$imgExtension");
        //   }
  
        //   if (!move_uploaded_file(
        //     $_FILES["img"]["tmp_name"],
        //     "coffee/$_FILES[img][name]"
        //   )) {
        //     $errors["img"] = "img is not exists";
        //   }
        //   if ($errors > 0) {
        //     $errorArray = json_encode($product->errors);
        //     header("location:login.php?errorArray=$errorArray");
        //   } else {
        //     $id = $product->id;
        //     $title = $product->title;
        //     $price = $product->price;
        //     $image = $product->image;
        //    $db->update("product", "title ='$title',price='$price',image='$image'", "id= $id");
        // header("location:AllProduct.php?length=$er");
        // }
      }
      ////////////////////product widthout image
      else{
        echo " empty";
        // if ($errors > 0) {
        //   $errorArray = json_encode($product->errors);
        //   header("location:login.php?errorArray=$errorArray");
        // } 
        // else {
        //   $id = $product->id;
        //   $title = $product->title;
        //   $price = $product->price;
        //   echo $id;
        //   echo $title;
        //   echo $price;
        //   $db->update("product", "title ='$title',price='$price'", "id= $id");

        //  header("location:AllProduct.php?length=$er");
        // }
      }
      } catch (PDOException $e) {
        echo $e;
      }
    }
    ?>