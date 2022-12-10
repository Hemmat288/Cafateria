<?php
class orders{
    // id	date	total_price	status	user_id	
    private $id;
    private $date;
    private $total_price;
    private $status;
    private $user_id;
    private $note;
    private $errors=[];
    function __construct()
    {
        
    }
    function __set($name,$value){
        // if($name=="name"){
        //     if(strlen($value)>=3){
        //     $this->$name=$value;
        //     }else{
        //         $this->errors['name']=" name must be more than 3 char";;
        //     }
        // }
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