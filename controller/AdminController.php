<?php
session_start();
$id = $_SESSION["adminId"];

function nameController($id){
    include "../conn.php";
    
    if(empty($_POST["pass"])){
        header("location:../admin/settings.php?info=error");
    }
    $pass = md5($_POST["pass"]);
    $name = $_POST["name"];
    
    $query = $db->prepare("SELECT * FROM admin WHERE adminId=:id");
    $query->execute(array(":id"=>$id));

    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row["adminPass"] != $pass){
        header("location:../admin/settings.php?info=error");
    }else{
        
        $insertquery = $db->prepare("UPDATE admin SET adminName=:aName WHERE adminId=:id");
        $insert = $insertquery->execute(array(":aName"=>$name, ":id"=>$id));

        if($insert){
            header("Location:../admin/settings.php?info=successful");
        }else{
            header("location:../admin/settings.php?info=error");
        }

    }
}

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

    if(in_array($file_ext, $extensions) === false) // arrayin içinde var mı yok mu kontrolu yapıyor 
    {
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        header("location:../admin/settings.php?info=error");
        exit;
    } 
 
    $imgQuery = $db->prepare("UPDATE admin SET avatar=:img WHERE adminId=:id");
    $imgInsert = $imgQuery->execute(array(":img"=>$file_name, ":id"=>$id));  

    if(!$imgInsert){
        header("location:../admin/settings.php?info=error");
    }
    
    $control = move_uploaded_file($file_tmp,"../upload/images/".$file_name);
    
    if($control == "0"){
        header("location:../admin/settings.php?info=error");
    }
    
    $_SESSION["imageName"] = $file_name;
    
    header("Location:../admin/settings.php?info=successful");
    
}

if(isset($_POST["nameBtn"])){
    nameController($id);
}else if(isset($_POST["imgBtn"])){ 
    imageController($id);
}else{
    header("location:../admin/settings.php?info=error");
}

?>