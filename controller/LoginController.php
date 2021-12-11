<?php
session_start();
include "../conn.php";

if(isset($_POST["loginBtn"])){

    if(isset($_POST["mail"]) && isset($_POST["password"])){
    
        $mail = $_POST["mail"];
        $pass = md5($_POST["password"]);
        
        $userSelect = $db->prepare("SELECT * FROM member WHERE (memberPassword=:pass AND mailAdress=:mail)");
        $userSelect->execute(array(":pass" => $pass, ":mail" => $mail));

        $row = $userSelect->fetch(PDO::FETCH_ASSOC); 
        
        if($userSelect->rowCount()){
            $_SESSION["login"] = true;
            $_SESSION["memberName"] = $row["memberName"];
            $_SESSION["memberId"] = $row["memberId"];

            header("Location: ../member/index.php");
        }else{
        
            $adminSelect = $db->prepare("SELECT * FROM admin WHERE (adminPass=:adminPass AND adminMail=:adminMail)");
            $adminSelect->execute(array(":adminPass" => $pass, ":adminMail" => $mail));

            $row = $adminSelect->fetch(PDO::FETCH_ASSOC); 

            if($adminSelect->rowCount()){
                $_SESSION["login"] = true;
                $_SESSION["adminName"] = $row["adminName"];
                $_SESSION["adminId"] = $row["adminId"];

                header("Location: ../admin/index.php");
            }else{
                header("location:../login.php?info=error");exit;
            }
        }
    }
    else{
        header("location:../login.php?info=error");exit; 
    }

}else{
    header("location:../login.php?info=error");exit; 
}
?>