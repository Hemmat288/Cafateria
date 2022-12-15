


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
while($data=$result -> fetch_assoc())
{
?>
 <div style="float:left;width:25%;" class="w-25 mt-2  text-center" >
     <h1 class="text-center"  ><?php echo $data['qty'] ." ".$data['title'] ; ?></h1>
     <img    src="coffee/<?php echo $data['image'];?>" style="width:60%;" height="100px" class="m-auto" >
    <h1 class="text-center"  ><?php echo $data['total_price'] ." LE" ?></h1>


  </div>
<?php
}

?>