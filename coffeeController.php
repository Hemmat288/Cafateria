    <?php


    require("user.php");
    require("product.php");
    require("orders.php");
    require("db.php");


    $db = new db();
    $connection = $db->get_connection();
    $user = new user();
    $product = new product();
    $orders = new orders();




    //   ----------------------------login user----------------------------
    if (isset($_POST['login'])) {
      $sudentData = $db->select("*", "user", " email='{$_POST['email']}' and password='{$_POST['password']}'");

      $studentinfo = $sudentData->fetch(PDO::FETCH_ASSOC);
      $email = $studentinfo["email"];
      $password = $studentinfo["password"];
      echo $email . "  " . $password;
      //////////////// $ sudentData check not work with me
      if ($password != "" && $email != "") {
        setcookie("name", $studentinfo["name"]);
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
        $user->room = $user->validation($_REQUEST['room_number']);
        $user->ext = $user->validation($_REQUEST['ext']);
        $user->image = $user->validation($_FILES["img"]["name"]);
        $errors = $user->countError();
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        $allowedExtension = ["png", "jpg", "txt"];

        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";

          header("location:adduser.php?errors=$imgExtension");
        }

        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],
          $_FILES["img"]["name"]
        )) {
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


     //   ----------------------------edit user----------------------------
     elseif (isset($_REQUEST['edit'])) {


      $id = $_REQUEST['id'];

      try {

        $datadb = $db->select("*","user","id=$id");

        $userEditData = json_encode($datadb->fetch(PDO::FETCH_ASSOC));

        header("location:editUser.php?userEditData=$userEditData");
      } catch (PDOException $e) {
        echo "connection failed";
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
    //   ----------------------------update user----------------------------

    else if (isset($_REQUEST['updateUser'])) {

      try {
        $user->name = $user->validation($_REQUEST['name']);
        $user->email = $user->validation($_REQUEST['email']);
        $user->password = $user->validation($_REQUEST['password']);
        $user->room = $user->validation($_REQUEST['room_number']);
        $user->ext = $user->validation($_REQUEST['ext']);
        $user->image = $user->validation($_FILES["img"]["name"]);
        $errors = $user->countError();
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
        $allowedExtension = ["png", "jpg", "txt"];

        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";

          header("location:adduser.php?errors=$imgExtension");
        }

        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],
          $_FILES["img"]["name"]
        )) {
          $errors["img"] = "img is not exists";
        }
        if ($errors > 0) {
          $errorArray = json_encode($student->errors);
          header("location:editUser.php?errorArray=$errorArray");
        } else {
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

          header("location:list.php?length=$er");
        }
      } catch (PDOException $e) {
        echo $e;
      }
    }
    //   ----------------------------add order----------------------------
    if (isset($_REQUEST['addorder'])) {
      try {
        $orders->total_price = $orders->validation($_REQUEST['total_price']);
        $orders->note = $orders->validation($_REQUEST['note']);
        $errors = $orders->countError();
        if ($errors > 0) {
          $errorArray = json_encode($student->errors);
          header("location:login.php?errorArray=$errorArray");
        } else {
          $total_price = $orders->total_price;
          $note = $orders->note;
          echo "hi2";
          $db->insert("orders", "
               total_price ='$total_price',
               note='$note'");
          header("location:Allorder.php?total_price=$total_price");
        }
      } catch (PDOException $e) {
        echo "error";
      }
    }

    //   ----------------------------add product----------------------------
    if (isset($_REQUEST['addproduct'])) {

      try {
        $product->title = $product->validation($_REQUEST['title']);
        $product->price = $product->validation($_REQUEST['price']);
        $product->image = $product->validation($_FILES["img"]["name"]);
        $errors = $product->countError();
        $imgExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);

        $allowedExtension = ["png", "jpg", "txt"];

        if (!in_array($imgExtension, $allowedExtension)) {
          $errors["imgExtension"] = "not in allow imgExtension";
          header("location:login.php?errors=$imgExtension");
        }

        if (!move_uploaded_file(
          $_FILES["img"]["tmp_name"],
          $_FILES["img"]["name"]
        )) {
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
    else if(isset($_REQUEST['edit'])){
      $id=$_REQUEST['id'];
      try {  
       $sudentData=$db->select("*","product","id=$id");
       
        $productinfo=$sudentData->fetch(PDO::FETCH_ASSOC);
         $dataproductEdit=json_encode($productinfo);
         header("location:editProduct.php?dataproductEdit=$dataproductEdit");
      }catch(PDOException $e){
       echo $e;
        }
        $connection = null;
      }
    //   ----------------------------show Student----------------------------
    elseif (isset($_REQUEST['show'])) {
      $id = $_REQUEST['id'];

      try {
        $data = $db->select(" * ",  "student",  "id=$id");

        $datainfo = json_encode($data->fetch(PDO::FETCH_ASSOC));

        header("location:show.php?data=$datainfo");
      } catch (PDOException $e) {
        echo "connection failed";
      }
    }
   
    ?>