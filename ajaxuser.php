


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



$result=$conn->query("select * from orders where user_id=$id");

while($data=$result -> fetch_assoc())
{
?>

 <tr>
<td class="open" ID="<?php echo $data['id'] ?>" ><?php echo $data['date']; ?></td>
<td><?php    echo "<button onclick='show(this)' ID='".$data['id']."'  type='button' class='btn open' style='color:#fff;background: #5C3D2E;'>+</button>" 
         ?></td>


<td><?php echo $data['status']; ?></td>
<td><?php  echo $data['total_price']." "." "."EGP"; ?></td>
</tr>
<?php
}

?>