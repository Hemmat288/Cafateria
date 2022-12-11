<?php
class order_details{
    // id	date	total_price	status	user_id	
    private $id;
    private $order_id;
    private $product_id;
    private $qty;
    private $price;
    private $errors=[];
    function __construct()
    {
        
    }
    function __set($name,$value){
        $this->$name=$value;
  }
  
  function __get($name)
  {
   return $this->$name;
  }
      


/////////////////validation
function validation($data){
    $data = htmlspecialchars(stripcslashes(trim($data)));
    return $data;
  }
  
  function countError(){
   return count($this->errors);
   

}

}
?>