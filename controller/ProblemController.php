<?php
session_start();

function Aktarma(){
    include "../conn.php";

    $id = $_GET["id"];
    $query = $db->prepare("UPDATE problem SET status=0 WHERE problemId=:id");
    $query->execute(array(":id" => $id));

    if($query->rowCount()){
        header("Location:../admin/problem.php?info=successful");
    }else{
        header("location:../admin/problem.php?info=error");
    }
}

if($_GET["islem"] == "aktarma"){
    Aktarma();
}
?>