<?php
include "../conn.php";

if(!$_POST) exit;

$name = $_POST["name"];
$mail = $_POST["mail"];
$sub = $_POST["subject"];
$msg = $_POST["message"];
$address = "damlaalim81@gmail.com";

if(trim($name) == '' || trim($mail) == '' || trim($msg) == '' || trim($sub) == '') {
	header("location:../contact-us.php?info=error");
	exit();
} 

$mailquery = $db->prepare("INSERT INTO mail SET userName=:name, userMail=:mail, subject=:sub, message=:msg");
$mailInsert = $mailquery->execute(array(":name"=>$name, ":mail"=>$mail, ":sub"=>$sub, ":msg"=>$msg));

if($mailInsert){
    header("location:../contact-us.php?info=successful");
}else{
    header("location:../contact-us.php?info=error");
}
?>