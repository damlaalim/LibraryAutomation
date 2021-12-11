<?php
session_start();
function MemberCriminal(){
    include "../conn.php";
    
    $query = $db->query("SELECT * FROM borrowing WHERE memberId={$_SESSION['memberId']}", PDO::FETCH_ASSOC);

    foreach($query as $row){ //kişiye ait tüm cezalar dönsün diye foreach kullandım
        $id = $row["borrowingId"];

        $timeStamp = strtotime($row["borrowingDate"]); //metinsel açıklamayı zaman damgasına çevirir
        $dTime = strtotime($row["deliveryDate"]); 

        if($dTime == null){ //Eğer deliveryDate'in içinde bir şey yoksa yani kitap teslim edilmemişse bu turu bitiricek
            continue;
        }

        $yearB = date("Y", $timeStamp); //borrowingDate'in yılını aldım
        $monthB = date("m", $timeStamp); //borrowingDate'in ayını aldım
        $dayB = date("d", $timeStamp); //borrowingDate'in gününü aldım
    
        $yearT = date("Y", $dTime); //deliveryDate'in yılını aldım
        $monthT = date("m", $dTime); //deliveryDate'in ayını aldım
        $dayT = date("d", $dTime); //deliveryDate'in gününü aldım
    
        $year = abs($yearT - $yearB); //yılları kendi arasında çıkartıp, sonucun mutlak değerini aldım
        $month = abs($monthT - $monthB);
        $day = abs($dayT - $dayB);
    
        if($year>0){$year*=365;} //yıl sonucu sıfırdan büyükse yılı güne çevirdim yani 365'le çarptım. Eğer bunu yapmasaydım yıl 2 olduğu zaman toplam sonuca sadece 2 ekleyecekti yani günmüş gibi kabul edecekti.
        if($month>0){$month*=30;} //ay sonucu sıfırdan büyükse ayı güne çevirdim yani 30'la çarptım
    
        $total = $year + $month + $day; //tüm sonuçları topladım
    
        $stmt = $db->prepare('CALL criminal(?,?)'); //SP'yi çağırdım
        $stmt->bindParam(1, $id, PDO::PARAM_INT); //SP'nin 1. değerine id'iy
        $stmt->bindParam(2, $total, PDO::PARAM_INT); //SP'nin 2. değerine toplam sonucu gönderdim
        
        $stmt->execute(); //SP'yi çalıştırdım
          
    }

    header("location:../member/index.php");exit;
}

function AllCriminal()
{
    include "../conn.php";
    
    $query = $db->query("SELECT * FROM borrowing", PDO::FETCH_ASSOC);

    foreach($query as $row){
        $id = $row["borrowingId"];

        $timeStamp = strtotime($row["borrowingDate"]);
        $dTime = strtotime($row["deliveryDate"]); 

        if($dTime == null){ 
            continue;
        }

        $yearB = date("Y", $timeStamp); 
        $monthB = date("m", $timeStamp); 
        $dayB = date("d", $timeStamp); 
    
        $yearT = date("Y", $dTime); 
        $monthT = date("m", $dTime); 
        $dayT = date("d", $dTime); 
    
        $year = abs($yearT - $yearB); 
        $month = abs($monthT - $monthB);
        $day = abs($dayT - $dayB);
    
        if($year>0){$year*=365;} 
        if($month>0){$month*=30;}
    
        $total = $year + $month + $day;
         
        $stmt = $db->prepare('CALL criminal(?,?)'); 
        $stmt->bindParam(1, $id, PDO::PARAM_INT); 
        $stmt->bindParam(2, $total, PDO::PARAM_INT);

        try{ 
            $stmt->execute();
            header("Location:../admin/criminal.php?info=successful");exit;
        }catch(Exception $e){
            echo "sp çalışmadı" . $e->getMessage(); 
            header("location:../admin/criminal.php?info=error");exit;
        }
    }
}

if(isset($_POST["criminalBtn"])){
    MemberCriminal(); 
}else if(isset($_POST["criminalAllBtn"])){
    AllCriminal(); 
}
?>