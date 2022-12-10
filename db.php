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
        return $this->connection->query("select $column  FROM $table JOIN  $table2 JOIN  $table3 JOIN  $table4 ON $condition");
     }
     function showdb(){
        return $this->connection->query("SHOW TABLES");
     }
}

?>

