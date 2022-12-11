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
  <title>Add order</title>
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

      <div>
        <!-- <img src="" width="50" height="50"> -->
        <p class="admin"> <?php echo "$_COOKIE[name]" ?></p>
      </div>

    </div>
  </nav>

  <!-- ///////////////////////////////////////body -->

  <!-----------------------------left form add order------------------------------>
  <div class="Addorder ">
    <div class="row backaddorder">

      <div class="col-md-4 addorderform">
        <form action="coffeeController.php" method="post" enctype="multipart/form-data">

  <!------------------------- user-->
<select name="selectedUserid" class="form-select userselect" aria-label="Default select example">
                  <?php
                   
                  $usersname = $db->show("id,name","user");
                  ?>
                  <option selected>Select user</option>
                  <?php
                  foreach ($usersname as $row) { ?>

                    <option value="<?php echo $row['id'] ?>" > <?php echo $row['name'] ?></option>
                  <?php
                  }
                  ?>
                </select>



          <!------------------------- ordes-->
          <div id="order_quentity">
          </div>
          <!------------------------- total_price-->

          <div class="form-group">
            <label>
              Total Price
              <input type="number" name="total_price" id="totalprice" value=0 class="form-control  TotalPriceOrder" id="exampleInputEmail1" readonly>
              <span class="egp">EGP<span>
            </label>
          </div>
          <!------------------------- Note -->

          <div class="form-group">
            <label>
              <textarea name="note" id="" cols="28" rows="2" placeholder="Write Any Note"></textarea>
            </label>

          </div>
          <input type="submit" name="addorder" class="ordersubmitbtn"></input>
          <button type="submit" class="ordersubmitbtn">reject</button>
        </form>

      </div>
      <!-----------------------------right lates order------------------------------>

      <div class="col-md-6">
        <div class="col-md-12">
          <h2>latest orders</h2>
          <div id="latesorder" class="row lates-orders">
          </div>
        </div>
        <hr>
        <!-----------------------------right our products------------------------------>
        <div class="col-md-12 allcards">
          <h2>Our Products</h2>
          <div class="row">

            <?php
            try {
              $data = $db->show("*", "product");
              $counter = 0;
              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {

                echo "<div class='card products product_in_order' id='$row[id]' src='coffee/$row[image]' product_title='$row[title]' product_price='$row[price]' >";
                echo "<img class='card-img-top' style='width:80; height:100;' src='coffee/$row[image]'>";
                echo "<div class='card-body'>";
                echo "<p>title : $row[title] </p>";
                echo "<p>Price : $row[price] </p>";
                echo "</div>";
                echo "</div>";
              }
            } catch (PDOException $e) {
              echo "error";
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var totalprice = 0;
    var products = [];
    var allprice = [];
    $(".products").click(function(e) {

      if (!products.includes($(this).attr("id"))) {

        var id = $(this).attr("id");
        products.push(id);
        var imgurl = $(this).attr("src");
        var product_price = $(this).attr("product_price");
        const product_title = $(this).attr("product_title");
        allprice[id] = Number(product_price);

        var product = `<div class='card product_in_order lates_card'>
<img class='card-img-top' style='width:80; height:100;' src='${imgurl}'>
<div class='card-body'>
         <p>title : ${product_title} </p>  
         </div>
         </div>
`
        $("#latesorder").append(product);


        var space = " ";
        product = `<input hidden name="productid[]" value="${id}"> 
        <input type="text" name="productname[]"
   value=${product_title} 
   class="form-control readonlyinputOrder " readonly  >

   <input 
    type="number" min=1  placeholder="${id}"  name="productcount[]"  
    product_price="${product_price}" value=1  onclick="convert(this,this.value)" 
    class="form-control countinputOrder" ">

<input type="number"
 id="${id}" name="productprice[]"
  value="${product_price}" class="form-control readonlyinputOrder"  readonly>

 ${space}  <span class="egp">LE<span><br><br>`;

        $("#order_quentity").prepend(product);
        var counter = 0;
        for (var x in allprice) {
          counter = counter + Number(allprice[x]);
        }
        $("#totalprice").val(counter);
      }
    });
    function convert(x, number) {
      let link = $(x).attr("placeholder")
      let product_price = $(x).attr("product_price");
      let finalprice = Number(product_price) *  Number(number);
      $(document).find(`#${link}`).val(Number(finalprice));
      allprice[link] = finalprice;
      var counter = 0;
      for (var x in allprice) {
        counter = counter + Number(allprice[x]);
      }

      $("#totalprice").val(counter);

    }
  </script>
  <script>
  </script>
</body>

</html>