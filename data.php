


<?php
$servername = "localhost";
$username = "root";
$password = "";
$id=$_GET['id'];
// Create connection
$conn = new mysqli($servername, $username, $password,"cafateria");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 



$result=$conn->query("SELECT user.name,orders.total_price,orders.date,orders.id,user.room_number,
user.ext,product.title,product.image,orders.status,order_details.price,order_details.qty
FROM orders JOIN order_details JOIN user JOIN product
ON 
orders.id=order_details.order_id AND
user.id=orders.user_id AND 
order_details.product_id=product.id
WHERE orders.id=$id");
?>
       <h4 style="color: #986644; text-align:center; margin:5%;">products</h4>
<?php
while($data=$result -> fetch_assoc())
{
?>
  <div style="float:left; width:25%; margin-top:1%; text-align:center; ">
    <div  class="position-relative">
    <img width="100" height="90" style="border-radius:10%" src="coffee/<?php echo $data['image']?>">
  <span style="background:#986644 !important;" class="position-absolute top-20 start-60 translate-middle p-2   badge rounded-pill bg-dark border border-light ">
  <?php echo $data['price']?>LE </span>
</div>
     <p class="p_detailsOrder"><?php echo$data['qty']."  " . $data['title']?></p>
    </div>
<?php
}

?>