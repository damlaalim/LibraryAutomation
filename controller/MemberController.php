<?php
session_start(); 
$id = $_SESSION["memberId"];

function imageController($id){
    include "../conn.php";

    if($_SESSION["imageName"]){ 
        unlink("../upload/images/".$_SESSION["imageName"]);
    }

    $ext = explode('.',$_FILES["image"]["name"]); // . ayraç görevi görüyor, öncesini bir indise sonrasını diğer indise koyuyor
    $file_ext = strtolower( end($ext) ); // dosya adının tüm harflerini küçültüp son değerini arraye koyuyor
    $file_name = uniqid().".".$file_ext; // dosyaya yeni isim veriyorum, benzersiz bir isim ve dosyanın uzantısı
    $file_tmp = $_FILES['image']['tmp_name']; // dosyanın geçici kaydedildiği yeri getiriyor
    $file_type = $_FILES['image']['type']; //dosyanın türünü getiriyor
    $extensions = array("jpeg","jpg","png"); //kabul edilecek uzantıları arraye koydu

    if(in_array($file_ext, $extensions) === false) // arrayin içinde var mı yok mu kontrolu yapıyor * === (denktir) içindeki veriler aynı olmalı ve tür aynı olmalı (int, str)
    {
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        header("location:../member/index.php?info=error");exit;
    } 
 
    $imgQuery = $db->prepare("UPDATE member SET avatar=:img WHERE memberId=:id");
    $imgInsert = $imgQuery->execute(array(":img"=>$file_name, ":id"=>$id));  

    if(!$imgInsert){header("location:../member/index.php?info=error");exit;}
    
    $control = move_uploaded_file($file_tmp,"../upload/images/".$file_name);
    
    if($control == "0"){header("location:../member/index.php?info=error");exit;}
    
    $_SESSION["imageName"] = $file_name;
    
    header("Location:../member/index.php?info=successful");
}


function nameController($id){ 
    include "../conn.php";

    if(empty($_POST["pass"])){ header("location:../member/index.php?info=error");exit; }
    $pass = md5($_POST["pass"]);
    $name = $_POST["name"];
    
    $query = $db->prepare("SELECT * FROM member WHERE memberId=:id");
    $query->execute(array(":id"=>$id));

    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row["memberPassword"] != $pass){
        header("location:../member/index.php?info=error");exit;
    }else{
        
        $insertquery = $db->prepare("UPDATE member SET memberName=:mName WHERE memberId=:id");
        $insert = $insertquery->execute(array(":mName"=>$name, ":id"=>$id));

        if($insert){
            header("Location:../member/index.php?info=successful");
        }else{
            header("location:../member/index.php?info=error");exit;
        }
    }
}

function Problem($id)
{
    include "../conn.php";

    $msg = $_POST["message"];
    $sjc = $_POST["subject"];
    $query = $db->prepare("INSERT INTO problem SET memberId=:id, subject=:sjc, problem=:msg, status=:sts");
    $problem = $query->execute(array(":id"=>$id, ":sjc"=>$sjc, ":msg"=>$msg, ":sts"=>1));

    if($problem){
        header("Location:../member/index.php?info=successful");exit;
    }else{
        header("location:../member/index.php?info=error");exit;
    }
}

if($_GET["islem"]=="problem"){
    if(empty($_POST["message"]) || empty($_POST["subject"])){
        header("location:../member/index.php?info=error");exit;
    }
    Problem($id);
}
if(isset($_POST["nameBtn"])){
    nameController($id);
}else if(isset($_POST["imgBtn"])){ 
    imageController($id);
}else{
    header("location:../member/index.php?info=error");exit;
}
?>