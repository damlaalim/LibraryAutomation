<?php
session_start();

function error(){
    if(isset($_SESSION["adminId"]) && empty($_SESSION["memberId"])){ 
        header("location:../admin/settings.php?info=error"); 
        exit;
    }else if(empty($_SESSION["adminId"]) && isset($_SESSION["memberId"])){ 
        header("location:../recover-password.php?info=error"); 
        exit;
    }
}

function adminPass($id, $pass, $newpass){
    include "../conn.php";
    $query = $db->prepare("SELECT adminPass FROM admin WHERE adminId=:id AND adminPass=:pass");
    $passSelect = $query->execute(array(":id"=>$id, ":pass"=>$pass));
    
    if(!$passSelect){ error(); }

    $insertquery = $db->prepare("UPDATE admin SET adminPass=:pass WHERE adminId=:id");
    $insert = $insertquery->execute(array(":pass"=>$newpass, ":id"=>$id));

    return $insert;
}

function memberPass($id, $pass, $newpass){
    include "../conn.php";
    $query = $db->prepare("SELECT memberPassword FROM member WHERE memberId=:id AND memberPassword=:pass");
    $passSelect = $query->execute(array(":id"=>$id, ":pass"=>$pass));

    if(!$passSelect) { error(); }
    
    $insertquery = $db->prepare("UPDATE member SET memberPassword=:pass WHERE memberId=:id");
    $insert = $insertquery->execute(array(":pass"=>$newpass, ":id"=>$id));
    
    return $insert;
}

// Şifre kontrolleri
if(!$_POST || !$_POST["newpass"] || !$_POST["repass"] || !$_POST["pass"] || strlen($_POST["newpass"]) < 8 || $_POST["newpass"] != $_POST["repass"]) 
{
    error();
} 

$pass = md5($_POST["pass"]);
$newpass = md5($_POST["newpass"]);

if(isset($_SESSION["adminId"]) && empty($_SESSION["memberId"])){ 
    $id = $_SESSION["adminId"];
    $insert = adminPass($id, $pass, $newpass);
}else if(empty($_SESSION["adminId"]) && isset($_SESSION["memberId"])){ 
    $id = $_SESSION["memberId"];
    $insert = memberPass($id, $pass, $newpass);
}

if($insert){session_destroy(); header("Location:../login.php");}
else{ error(); }

?>