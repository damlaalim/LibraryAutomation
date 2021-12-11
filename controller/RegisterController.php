<?php
include "../conn.php";
if(!$_POST){ exit; }
    
$name = $_POST["name"];
$mail = $_POST["mail"];
$pass = $_POST["pass"];
$rePass = $_POST["rePass"];

if(!$name && !$mail && !$pass && !$rePass){ header("location:../register.php?info=error");exit;}
    
$userSelect = $db->query("SELECT * FROM member WHERE mailAdress='$mail'", PDO::FETCH_ASSOC);
    
if($userSelect->rowCount()){
    header("location:../register.php?info=error");exit;
}else{
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){header("location:../register.php?info=error"); exit;}

    $uzunluk = strlen($pass);
    if($uzunluk<8){
        print "şifrenizi en az 8 karakter tanımlayabilirsiniz";
    }else{
        if($pass != $rePass){
            header("location:../register.php?info=error");exit;
        }else{
            $pass = md5($pass);
            $query = $db->prepare("INSERT INTO member SET memberName=:mName, memberPassword=:mPass, mailAdress=:mMail");
            $insert = $query->execute(array(":mName"=>$name, ":mPass"=>$pass, ":mMail"=>$mail));

            if($insert){
                header("location:../login.php");
            }else{
                header("location:../register.php?info=error");
            }
        }
    }
}        
?>