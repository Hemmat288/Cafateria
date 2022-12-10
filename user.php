<?php
 

//  id	name	email	password	image	ext	room_number 

class user{
private $id;
private $name;
private $email;
private $password;
private $image;
private $room_number;
private $ext;
private $errors=[];
function __construct()
{
    
}

function __set($name,$value){
    if($name=="name"){
        if(strlen($value)>=3){
        $this->$name=$value;
        }else{
            $this->errors['name']="name must be more than 3 char";;
        }
    }
  
      if($name==="email"){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            $this->$name=$value;
        } else{
               $this->errors["email"] = "pls enter valid email";
        }
  }
  
  else{
      $this->$name=$value;
      
  }
  
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