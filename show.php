<?php

if($_COOKIE["fname"]){
    echo" <h2>Welcome  {$_COOKIE["fname"]}</h2>" ;
}
else{
  header("location:login.php");
}

 if(isset($_REQUEST['data'])){
 $data=json_decode($_REQUEST['data']);

        foreach($data as $k=>$v){
echo $k."  ".$v."<br>";
        }

    } 


 

 

 

 
?>