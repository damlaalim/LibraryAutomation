<?php
$islem= $_GET["islem"];

function AddAuthor()
{
    include "../conn.php";

    $name = $_POST["aName"];
    $control = $db->query("SELECT * FROM author WHERE authorName='{$name}'", PDO::FETCH_ASSOC);


    if($control->rowCount()){header("location:../admin/booklist.php?info=error"); exit;}

    $query = $db->prepare("INSERT INTO author SET authorName=:name");
    $insert = $query->execute(array(":name"=>$name));
    
    if($insert){
        header("Location:../admin/booklist.php?info=successful");
    }
}

function AddCategory()
{
    include "../conn.php";

    $ctg = $_POST["category"];
    $control = $db->query("SELECT * FROM category WHERE categoryName='{$ctg}'", PDO::FETCH_ASSOC);

    if($control->rowCount()){header("location:../admin/booklist.php?info=error"); exit;}

    $query = $db->prepare("INSERT INTO category SET categoryName=:ctg");
    $insert = $query->execute(array(":ctg"=>$ctg));

    if($insert){
        header("Location:../admin/booklist.php?info=successful");
    }
}

function AddLang()
{
    include "../conn.php";

    $lang = $_POST["lang"];
    $control = $db->query("SELECT * FROM language WHERE lang='{$lang}'", PDO::FETCH_ASSOC);

    if($control->rowCount()){header("location:../admin/booklist.php?info=error"); exit;}

    $query = $db->prepare("INSERT INTO language SET lang=:lang");
    $insert = $query->execute(array(":lang"=>$lang));

    if($insert){
        header("Location:../admin/booklist.php?info=successful");
    }
}

function AddPub()
{
    include "../conn.php";

    $pub = $_POST["pub"];
    $ctr = $_POST["center"];
    $control = $db->query("SELECT * FROM publisher WHERE publisherName='{$pub}' AND center='{$ctr}'", PDO::FETCH_ASSOC);

    if($control->rowCount()){header("location:../admin/booklist.php?info=error"); exit;}

    $query = $db->prepare("INSERT INTO publisher SET publisherName=:pub , center=:ctr");
    $insert = $query->execute(array(":pub"=>$pub, ":ctr"=>$ctr));

    if($insert){
        header("Location:../admin/booklist.php?info=successful");
    }
}

function AddBook()
{
    include "../conn.php";

    $book = $_POST["bName"];
    $authorId = $_POST["aName"];
    $categoryId = $_POST["category"];
    $page = $_POST["page"];
    $year = $_POST["year"];
    $langId = $_POST["lang"];
    $pubId = $_POST["pub"];
    $desc = $_POST["description"];
    $stock = $_POST["stock"];

    $control = $db->query("SELECT * FROM book WHERE bookName='{$book}' AND authorId='{$authorId}' AND categoryId='{$categoryId}' AND publisherId='{$pubId}'", PDO::FETCH_ASSOC);

    if($control->rowCount()){header("location:../admin/booklist.php?info=error"); exit;}

    $query = $db->prepare("INSERT INTO book SET bookName=:b , authorId=:a, categoryId=:c, stock=:s, numberOfPage=:n, yearOfPrinting=:y, publisherId=:p, languageId=:l, description=:d");
    $insert = $query->execute(array(":b"=>$book, ":a"=>$authorId, ":c"=>$categoryId, ":s"=>$stock, ":n"=>$page, ":y"=>$year, ":p"=>$pubId, ":l"=>$langId, ":d"=>$desc));

    if($insert){
        header("Location:../admin/booklist.php?info=successful");
    }
}

function DelBook()
{
    include "../conn.php";

    $id = $_GET["id"];
    $query = $db->prepare("DELETE FROM book WHERE bookId=:id");
    $del = $query->execute(array(":id"=>$id));

    if($del){
        header("Location:../admin/booklist.php?info=successful"); exit;
    }else{
        header("location:../admin/booklist.php?info=error"); exit;
    }
}

function UpBook()
{
    include "../conn.php";

    $id = $_GET["id"];
    $bName = $_POST["bName"];
    $aName = $_POST["aName"];
    $category = $_POST["category"];
    $page = $_POST["page"];
    $year = $_POST["year"];
    $lang = $_POST["lang"];
    $pub = $_POST["pub"];
    $desc = $_POST["description"];
    $stock = $_POST["stock"];

    $query = $db->prepare("UPDATE book SET bookName=:book, authorId=:a, categoryId=:c, stock=:s, numberOfPage=:p, yearOfPrinting=:y, publisherId=:pub, languageId=:l, description=:d WHERE bookId=:id");
    $update = $query->execute(array(":book"=>$bName, ":a"=>$aName, ":c"=>$category, ":p"=>$page, ":y"=>$year, ":l"=>$lang, ":pub"=>$pub, ":d"=>$desc, ":s"=>$stock, ":id"=>$id));
    
    if($update){
        header("Location:../admin/booklist.php?info=successful"); exit;
    }else{
        header("location:../admin/booklist.php?info=error"); exit;
    }
}

switch($islem){
    case "author":
        AddAuthor();
        break;
    case "category":
        AddCategory();
        break;
    case "lang":
        AddLang();
        break;
    case "pub":
        AddPub();
        break;   
    case "book":
        AddBook();
        break;     
    case "delete":
        DelBook();
        break;  
    case "update":
        UpBook();
        break; 
}

?>