<?php
session_start();
include "../conn.php";

$id = $_GET["id"];
$islem = $_GET["islem"];
$memberId = $_SESSION["memberId"];
$date = date("Y/m/d");

if($islem=="i"){

    $favquery = $db->prepare("INSERT INTO favoritebooks SET memberId=:member, bookId=:book");
    $control = $favquery->execute(array(":member" => $memberId, ":book" => $id));   
    
    if($control){
        header("Location:../index.php?info=successful");
    }else{
        header("location:../index.php?info=error");
    }
  
}else if($islem=="e"){

    $fId = $_GET["fId"];
    
    $borrowquery = $db->prepare("INSERT INTO borrowing SET memberId=:member, bookId=:book, borrowingDate=:bDate, deliveryControl=:cont, criminalControl=:criminal");
    $bInsert = $borrowquery->execute(array(":member" => $memberId, ":book"=>$id, ":cont"=>"1", ":criminal"=>"1",":bDate"=>$date));    
    
    if(!$bInsert) {header("location:../member/index.php?info=error"); exit;}
    
    $favquery = $db->prepare("DELETE FROM favoritebooks WHERE fbId=:id");
    $control = $favquery->execute(array(':id' => $fId));

    if($control){
        header("Location:../member/index.php?info=successful");
    }else{
        header("location:../admin/settings.php?info=error");
    }

}else if($islem=="s"){

    $favquery = $db->prepare("DELETE FROM favoritebooks WHERE fbId=:id");
    $control = $favquery->execute(array(':id' => $id));

    if($control){
        header("Location:../member/index.php?info=successful");
    }else{
        header("location:../admin/settings.php?info=error");
    }

}else if($islem=="b"){
    $criminal = $db->query("SELECT criminal FROM borrowing WHERE borrowingId={$id}", PDO::FETCH_ASSOC);
    $row = $criminal->fetch(PDO::FETCH_ASSOC);
    
    $criminalControl = 0;
    if($row["criminal"] != 0)
    {
        $criminalControl = 1;
    } 

    $borrowquery = $db->prepare("UPDATE borrowing SET deliveryDate=:dDate, deliveryControl=0, criminalControl={$criminalControl} WHERE borrowingId=:id");
    $control = $borrowquery->execute(array(":dDate" => $date, ":id" => $id));

    if($control){
        header("Location:../member/index.php?info=successful");
    }else{
        header("location:../admin/settings.php?info=error");
    }

}else if($islem=="k"){

    $borrowquery = $db->prepare("DELETE FROM borrowing WHERE borrowingId=:id");
    $control = $borrowquery->execute(array(':id' => $id));
    
    if($control){
        header("Location:../member/index.php?info=successful");
    }else{
        header("location:../admin/settings.php?info=error");
    }
}



?>