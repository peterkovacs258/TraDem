<?php
require_once 'CONFIG/start.php';
echo file_get_contents("HTML/header.html");

if(isLogged())
{include "HTML/menuIn.php";
$uid=$_SESSION['user']['id'];
$szemelyes= keresUserbyFid($uid);
 $varosinfo=keresVaros($szemelyes['varosid']); 
 $profilkep= keresProfilKep($uid);

$html='<div align="center" class="container w-100 mt-5">
  <div class="w-75">
       <h5>'.$szemelyes['nev'].'</h5>
       <img class="border shadow-sm mb-1"  style="height:250px;" src="'.$profilkep.'"><br>
       <div class=" w-50">
      <form method="post" enctype="multipart/form-data" action="#">
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="file">
      <label class="custom-file-label" for="customFile">Profilkép megváltoztatása</label>
       <div class="hide" id="buttonProfilMentes" data-id="'.$uid.'"><input type="submit" class="col-6 btn shadow-sm btn-light border" value="Mentés"></div>
    </div>
    </form>
      </div>

   </div>
   <div align="left" class="container shadow-sm">
       <h3>Saját cseréim<button value="1" id="SajatCserekShow" class="btn btn-light border m-5 shadow-sm col-3">Mutasd</button></h3> 
       <div id="cserekHide" style="display:none">
';

$sql="SELECT * FROM CSEREK WHERE userid=".$szemelyes['id'];
$res= mysqli_query($connect, $sql);
if(!$res){$error="nem sikerült végrehajtani a lekérdezést";}
else
{
    while($row=$res->fetch_assoc())
    {
        $kepek= keresKepek($row['csID']);
        if(empty($kepek))
               {$kepek[0]="IMG/proba.jpg";}
               
$html.='<div id="kartya" class="card w-50" >'
        . '<img class="card-image-top mt-2 w-25" src="'.$kepek[0].'" style="margin:auto;">'
                       . '<div class="card-body">'
                       . '<h4 class="card-title" style="text-align:center">'.$row['megnevezes'].'</h4>'
                                          . '<h5 class="card-text"> Érték: '.number_format($row['ertek'], 0, '.', ',').' Ft </h5>'
                   . '<div class="row">'
                   . '<p class="card-text col"> Feltöltve: '.$row['feltoltesdatuma'].'. </p>'
                       . '</div>'
                   . '<a data-csid="'.$row['csID'].'" class="btnMegtekintes btn btn-primary  mr-3" href="#" id="btnMegtekintes">Részletek</a>'
                   . '<a data-csid="'.$row['csID'].'" class="btnTorles btn btn-danger " href="#">Törlés</a>'
                       . '</div>'
                       . '</div>' ;
    }
}
                           
   $html.='</div></div><div align="left" class="container w-100 shadow-sm" style="font-size: 20px;">
        <h3>Adatok</h3>
         <table class="table ">
                <tr><td class="p-3">Email:</td><td class="p-3">'.$szemelyes['email'].'</td></tr>
                <tr><td class="p-3">Város:</td><td class="p-3">'.$varosinfo['city'].'</td></tr>
                <tr><td class="p-3">Cím:</td><td class="p-3">'.$szemelyes['address'].'</td></tr>
                <tr><td class="p-3">Telefon:</td><td class="p-3">'.$szemelyes['phone'].'</td></tr>
                <tr><td class="p-3">Regisztrált:</td><td class="p-3">'.$szemelyes['regdate'].'</td></tr>
         </table>
   </div>             
   <div align="left" class="container shadow-sm">
        <h3>Beállítások</h3>
        <table class="table " style="font-size: 20px; font-weight:bold;">
            <tr>
                <td class="p-4">Email:</td>
                <td class="p-4"><input id="EMszerkesztInput"  type="text" placeholder="'.$szemelyes['email'].'" readonly=""></td>
                <td class="p-4">
                <button class="btn btn-light shadow-sm border " style="width:120px;" id="EMszerkeszt">Szerkesztés</button>
                 <button style="display:none" data-azonosito="'.$uid.'" style="width:120px;" class="btn btn-light border shadow-sm " id="EMszerkeszt2">Mentés</button>

                    </td>
            </tr>
                <tr>
                    <td class="p-4">Jelszó</td>
                    <td class="p-4"><input type="text" placeholder="******" readonly></td>
                    <td class="p-4"><button class="btn btn-light border shadow-sm" style="width:120px;" id="PWszerkeszt">Szerkesztés</button></td></tr>                      
            </table>
    </div>     
</div>
';

echo $html;
  $allowedImageTypes = array("image/png", "image/jpg", "image/jpeg", "image/bmp");
if((!empty($_FILES['file']))&&($_SERVER['REQUEST_METHOD']=='POST'))
{
    $file=$_FILES['file'];
    $tmpName = $file['tmp_name'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $kepeleres="IMG/Profile/";
    if (in_array($fileType, $allowedImageTypes)) {
      
                $dotposition= strrpos($fileName,".");
                if(file_exists($kepeleres.$fileName))
                {
                $fileName=time().'_'.$fileName;   
               
                } 
                   $sql="UPDATE szemelyesadatok set profilkep=? where felhasznaloid=?";
                   $stmt=$connect->prepare($sql);
                   $stmt->bind_param("si",$fileName,$uid); 
                   $stmt->execute();

                $_SESSION['user']['ppic']=$fileName;
                move_uploaded_file($tmpName, $kepeleres . $fileName);//áthelyezi a képet
               alertThanMove("Sikeresen megváltoztattad a profilképed","personal.php","success");

}
}
}
else
{
    alertThanMove("Jelentkezz be a profilod megtekintéséhez", "login.php","error");
}
echo file_get_contents("HTML/footer.html");

