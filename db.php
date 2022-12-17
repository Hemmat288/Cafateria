<?php
//  



class db{
    private $dbtype="mysql";
    private $password="";
    private $username="root";
    private $host="localhost";
    private $dbname="cafateria";
    private $connection;


public function __construct()
{
    $this->connection=new pdo("$this->dbtype:host=$this->host;dbname=$this->dbname", "$this->username","$this->password");
}
public function get_connection(){
    return $this->connection;
}
function select($column ,$table ,$condition){
    return $this->connection->query  ("select $column from $table where $condition");
     }
 
     function delete($table,$condition){
           return $this->connection->query ("delete from $table where $condition");
     }
     function insert ($table ,$value){
         return $this->connection->query ("INSERT into $table set $value");
     }
     function update($table,$value,$condition){
         return $this->connection->query("update $table set $value where $condition");
     }

       function show($column ,$table){
    return $this->connection->query  ("select $column from $table");
     }
     function details($column,$table,$table2 ,$table3 ,$table4 ,$condition){
        $sth =$this->connection->prepare("select $column  FROM $table JOIN  $table2 JOIN  $table3 JOIN  $table4 ON $condition");
        $sth->execute();
        return  $result = $sth->fetchAll();
    }
     function myorderdetails($column,$table,$table2 ,$table3 ,$table4 ,$condition,$condition2){
     $sth= $this->connection->query("select $column  FROM $table JOIN  $table2 JOIN  $table3 JOIN  $table4 ON $condition WHERE $condition2");
        $sth->execute();
        return  $result = $sth->fetchAll();
    }

     function showMix($column , $table){
        $sth =$this->connection->prepare("select MAX($column) FROM $table");
        $sth->execute();
     $result = $sth->fetchAll();
    foreach($result as $key=>$row)
    {
        return  $orderid= $row['MAX(id)'];
    }
     }

function filterUserbyIdUsingData($column,$table,$condition1,$condition2)
{
  $sth=$this->connection->prepare("select $column from $table where $condition1 AND $condition2");
        $sth->execute();
        return $result = $sth->fetchAll();
}

//////////////////////////////////////////// on check.php get user and totla price of her order in filter Date or user filter
function getUsersByFilter($column,$table,$table2,$condition1,$condition2,$groupbytable){
    $sth=$this->connection->prepare("select $column from $table join $table2 on $condition1 where $condition2  GROUP BY $groupbytable");
    $sth->execute();
    return $result = $sth->fetchAll();
}
//////////////////////////////////////////// on check.php get user and totla price of her order withoutttttt filter Date
function getUsersAndHerOrder($column,$table,$table2,$condition1,$groupbytable){
    $sth=$this->connection->prepare("select $column from $table join $table2 on $condition1   GROUP BY $groupbytable");
    $sth->execute();
    return $result = $sth->fetchAll();
}




     function showdb(){
        return $this->connection->query("SHOW TABLES");
     }
}

?>

