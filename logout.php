<?php
session_start();
session_destroy();
// if (isset($_COOKIE['name'])) {
//     unset($_COOKIE['name']); 
//     setcookie('name', null, -1, '/'); 
//     return true;
// } else {
//     return false;
// }
header('Location:login.php');