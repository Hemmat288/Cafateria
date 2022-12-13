<?php
 


class product{
private $id;
private $title;
private $image;
private $price;
private $is_available;
private $category_id;
private $errors=[];
function __construct()
{
    
}

function __set($name,$value){
    if($name=="title"){
        if(strlen($value)>=3){
        $this->$name=$value;
        }else{
            $this->errors['title']="title must be more than 3 char";;
        }
    }
    if($name=="price"){
        if($value>2){
        $this->$name=$value;
        }else{
            $this->errors['price']="price must be more than 5";;
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