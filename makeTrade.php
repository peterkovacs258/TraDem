<?php
require_once 'CONFIG/start.php';
echo file_get_contents("HTML/header.html");
if(!isLogged()){    alertThanMove("Csere hirdetés feladásához kérem jelentkezzen be", "login.php","error");  }
else
{include"HTML/menuIn.php";
echo file_get_contents("HTML/makeTradeKepekKategoria.html");
echo file_get_contents("HTML/makeTrade.html");


//CSERE FELTÖLTÉSE ADATBÁZISBA KÉPEK NÉLKÜL
$user= keresUserbyFid($_SESSION['user']['id']);
$userid = ($user['id']);
if (($_SERVER['REQUEST_METHOD']=='POST')&&(!empty($_POST['kategoriak']))&&(!empty($_POST['ertek']))&&
        (!empty($_POST['megnevezes']))&&(!empty($_POST['leiras']))&&(!empty($_POST['cserekategoria']))&&(!empty($_POST['cserelne']))){
    //Adatok összegyüjtése
    $kategoriaid=$_POST['kategoriak'];
    $alkategoriaid=$_POST['alkategoriak'];
    $ertek=$_POST['ertek'];
    $megnevezes=$_POST['megnevezes'];
    $leiras=$_POST['leiras'];
    $csereleiras=$_POST['cserelne'];
    $cserekategoria=$_POST['cserekategoria'];
    $cserealkategoriaid=$_POST['cserealkategoria'];
    $allapotid=1;

   if(!empty($_POST['cserealkategoria'])){$cserealkategoria=$_POST['cserealkategoria'];}


  if(isset($_POST['allapot'])){$allapot=$_POST['allapot'];}
   $sql ="INSERT INTO cserek(kategoriaid, alkategoriaid, megnevezes, allapotid,
       ertek, feltoltesdatuma, reszletek, userid, cserekat, cserealkat, csereleiras)
       VALUES (?,?,?,?,?,CURRENT_TIMESTAMP(),?,$userid,?,?,?)";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("iisiisiis",$kategoriaid,$alkategoriaid,$megnevezes,$allapotid,
                                            $ertek,$leiras,$cserekategoria,$cserealkategoriaid,$csereleiras);
              
              $stmt->execute();
     $res= mysqli_query($connect,'SELECT csID from cserek WHERE userid='.$userid.' AND reszletek LIKE "'.$leiras.'"');       
      $row= mysqli_fetch_array($res) ;
      $csID=$row['csID'];  
              
              
  ////Amennyiben csatoltak képet a cseréhez, kép feltöltése addatbázisba
  $allowedImageTypes = array("image/png", "image/jpg", "image/jpeg", "image/bmp");
      if(!empty($_FILES['file'])){
           
  
                $file = $_FILES['file'];
                $fileCount = count($file["name"]);

               
                
                for ($i = 0; $i < $fileCount; $i++) {
           $fileName = $file['name'][$i];
           $tmpName = $file['tmp_name'][$i];
           $fileType = $file['type'][$i];
           
           $kepeleres='';
           switch ($kategoriaid){
               case 1 :$kepeleres='IMG/Jarmu/';   break;
               case 2 :$kepeleres='IMG/Szamitogep/';   break;
               case 4 :$kepeleres='IMG/Jatek/';   break;
               case 5 :$kepeleres='IMG/Divat/';   break;
               case 6 :$kepeleres='IMG/Hobbi/';   break;
               case 7 :$kepeleres='IMG/Haztartas/';   break;
               case 8 :$kepeleres='IMG/Muszaki/';   break;
               case 9 :$kepeleres='IMG/Iroda/';   break;
               case 10 :$kepeleres='IMG/Sport/';   break;
               case 11 :$kepeleres='IMG/Otthon/';   break;                                                 
           }
          if (in_array($fileType, $allowedImageTypes)) {
      
                $dotposition= strrpos($fileName,".");
                if(file_exists($kepeleres.$fileName))
                {
                $fileName=time().'_'.$fileName;   
               
                } 
                $sql = "INSERT INTO kepek (csereid,kepnev,keputvonal) VALUES (?,?,?)";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("iss", $csID, $fileName, $kepeleres);
                $stmt->execute();
                

                move_uploaded_file($tmpName, $kepeleres . $fileName);//áthelyezi a képet

                alert("Sikeres feltöltés", "success");   
                    
                }
                        
          
          
                                         
              //  $fileName .= "_".time();
            }
        }
   // alertThanMove("Sikeres feltöltés !","index.php");


    
}
}

echo file_get_contents("HTML/footer.html");
