<?php
session_start();

if(!$_POST) {exit;}

function error(){
    if(isset($_SESSION["memberId"])){
        header("location:../recover-mail.php?info=error"); 
        exit;
    }else if(isset($_SESSION["adminId"])){
        header("location:../admin/settings.php?info=error"); 
        exit;
    }
    
}

function adminMail($id, $mail, $pass){
    include "../conn.php";
    
    //Şifre doğru mu diye baküyrüz
    $query = $db->prepare("SELECT * FROM admin WHERE adminId=:id AND adminPass=:pass");
    $query->execute(array(":id"=>$id, ":pass"=>$pass));

    if($query->rowCount() == 0) { error(); }
    
    //admin tablosunda bu mailde kayıtlı biri var mı diye baküyrüz
    $mailquery = $db->prepare("SELECT * FROM admin WHERE adminMail=:mail");
    $mailSelect = $mailquery->execute(array(":mail"=>$mail));

    if($mailquery->rowCount()) { error(); }
    
    //member tablosunda bu mailde kayıtlı biri var mı diye baküyrüz
    $mailquery = $db->prepare("SELECT * FROM member WHERE mailAdress=:mail");
    $mailSelect = $mailquery->execute(array(":mail"=>$mail));

    if($mailquery->rowCount()) { error(); }

    $insertquery = $db->prepare("UPDATE admin SET adminMail=:mail WHERE adminId=:id");
    $insert = $insertquery->execute(array(":mail"=>$mail, ":id"=>$id));

    return $insert;
}

function memberMail($id, $mail, $pass){
    include "../conn.php";

    $query = $db->prepare("SELECT * FROM member WHERE memberId=:id AND memberPassword=:pass");
    $passSelect = $query->execute(array(":id"=>$id, ":pass"=>$pass));
    
    if($query->rowCount() == 0) { error(); }

    //member tablosunda bu mail ile kayıtlı biri var mı diye baküyrüz
    $mailquery = $db->prepare("SELECT * FROM member WHERE mailAdress=:mail");
    $mailSelect = $mailquery->execute(array(":mail"=>$mail));
    
    if($mailquery->rowCount()) { error(); }

    //admin tablosunda bu mailde kayıtlı biri var mı diye baküyrüz
    $mailquery = $db->prepare("SELECT * FROM admin WHERE adminMail=:mail");
    $mailSelect = $mailquery->execute(array(":mail"=>$mail));

    if($mailquery->rowCount()) { error(); }

    $insertquery = $db->prepare("UPDATE member SET mailAdress=:mail WHERE memberID=:id");
    $insert = $insertquery->execute(array(":mail"=>$mail, ":id"=>$id));

    return $insert;
}

if(!$_POST["mail"] || !$_POST["pass"]) { error(); }
$mail = $_POST["mail"];
$pass = md5($_POST["pass"]);

if(isset($_SESSION["memberId"])){
    $id = $_SESSION["memberId"];
    $insert = memberMail($id, $mail, $pass);
}else if(isset($_SESSION["adminId"])){
    $id = $_SESSION["adminId"];
    $insert = adminMail($id, $mail, $pass);
}

if($insert){session_destroy(); header("Location:../login.php");}
else{ error(); }
?>