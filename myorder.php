<?php
session_start();
if ($_SESSION["name"]) {

    require("orders.php");
    require("user.php");
    require("product.php");
    require("db.php");


    $db = new db();
    $connection = $db->get_connection();
    $product = new product();
    $orders = new orders();
    $user = new user();


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <title>my order</title>
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

        <div class="allorders">
            <!-- ----------------------------------form for filter------------- -->
            <form action="" method="get">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <br>
                            <input type="date" name="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <br>
                            <input type="date" name="to_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Filter</label>
                            <br>
                            <button type="submit" class="btn" style="color:#fff;background: #5C3D2E;">filter</button>
                        </div>
                    </div>
            </form>

            <?php
            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {

                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                $id = $_SESSION['id'];
                $allordersprice = 0;

                $userorders = $db->filterUserbyIdUsingData("*", "orders", "user_id=$id ", "date BETWEEN '$from_date' AND '$to_date'");
            ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">order Date</th>
                            <th scope="col">open</th>
                            <th scope="col">close</th>
                            <th scope="col"> status</th>
                            <th scope="col">Amount</th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($userorders as $key => $row) {
                                $allordersprice = $allordersprice + (int)$row['total_price'];

                                echo "<td class='open' ID=$row[id]>$row[date]</td>";
                                echo "<td><button ID=$row[id] type='button' class='open btn' style='color:#fff;background: #5C3D2E;'>+</button></td>";
                                echo "<td style='padding-right:6%'><button type='button' class='close btn ' style='color:#fff;background: #5C3D2E;padding:0% 42% 32% 30%;'>_</button></td>";
                                echo "<td>$row[status]</td>";
                                echo "<td> $allordersprice</td>";
                                if($row["status"]=="processing"){
                                    echo "<td><a  class='btn btn-danger' href='coffeeController.php?id={$row['id']}&deleteOrder'>Cancel</a></td>";
                                    }else{
                                        echo "<td><a  class='btn btn-success' href='coffeeController.php?id={$row['id']}&deleteOrder'>Cancel</a></td>";
                                    
                                    }
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
                <div class="container " id="demo">

                </div>
            <?php

            } else {
                $id = $_SESSION['id'];
                $allordersprice = 0;
                $userorders = $db->select("*", "orders", "user_id=$id");
            ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">order Date</th>
                            <th scope="col">open</th>
                            <th scope="col">close</th>
                            <th scope="col"> status</th>
                            <th scope="col">Amount</th>
                            <th scope="col"> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($userorders as $key => $row) {
                                $allordersprice = $allordersprice + (int)$row['total_price'];

                                echo "<td class='open' ID=$row[id]>$row[date]</td>";
                                echo "<td><button ID=$row[id] type='button' class='open btn' style='color:#fff;background: #5C3D2E;'>+</button></td>";
                                echo "<td style='padding-right:6%'><button type='button' class='close btn ' style='color:#fff;background: #5C3D2E;padding:0% 42% 32% 30%;'>_</button></td>";
                                echo "<td>$row[status]</td>";
                                echo "<td> $allordersprice</td>";
                                if($row["status"]=="processing"){
                                echo "<td><a  class='btn btn-danger' href='coffeeController.php?id={$row['id']}&deleteOrder'>Cancel</a></td>";
                                }else{
                                    echo "<td><a  class='btn btn-success'>Cancel</a></td>";
                                
                                }
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
                <div class="container" id="demo">

                </div>
            <?php
            }
            ?>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
            <script>
                $(".open").click(function(e) {
                    e.preventDefault();
                    var id = $(this).attr("ID");
                    $.ajax({
                        type: 'GET',
                        url: "data.php",
                        data: {
                            id: id
                        },
                        datatype: "html",
                        success: function(data) {
                            $("#demo").html(data);
                        }
                    });
                });

                $(".close").click(function(e) {


                    $("#demo").html("");

                });
            </script>

    </html>

<?php


} else {
    header("location:login.php");
}

?>