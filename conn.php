<?php 

try{
    $db = new PDO("mysql:host=localhost;dbname=library;charset=utf8", "root", "");
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>