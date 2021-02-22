      <?php 

  function isLogged() {
    if (!empty($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
 }

function carouselType($size)
{$return=' <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
    
     if($size==2){
        $return=' <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';
    }else if ($size==3){
     $return=' <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>';
    }else if($size>3){
    $return=' <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>'
    .'<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>';

    }
    return $return;
}

function alertThanMove($msg,$path,$type) {
echo "<script scr='sweetalert2.all.min.js'></script>"
."<script type='text/javascript'>"
."setTimeout(function () { Swal.fire('".$msg."','','".$type."')"
 . ".then((result) => {if (result.value) {window.location='".$path."';} });}, 100); "
."</script>";
 
}
function alert($msg,$type) {
echo '<script scr="sweetalert2.all.min.js"></script>'
.'<script type="text/javascript">'
.'setTimeout(function () { Swal.fire("'.$msg.'","","'.$type.'");'
.'}, 100);'
.'</script>';
 
}



function keresMegye($megyeid){
    $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');

    $res= mysqli_query($connect, "SELECT * FROM megye WHERE Id=$megyeid");
    while($row = mysqli_fetch_array($res))
    {return $row['MegyeNev'];}
 }
 
function keresVaros($cityId){
     $city=array();
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
    $res= mysqli_query($connect, "SELECT DISTINCT * FROM varos WHERE Id=$cityId");
    $row = mysqli_fetch_array($res);
    $city['city']= $row['telepulesnev'];
      $megyeeid=$row['megyeid'];
      $city['stateID']=$megyeeid;
      $city['state']=keresMegye($megyeeid);
      return $city;
    
 }
 
 function keresKepek($tradeid){  
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
     $kepek=array();
    $res= mysqli_query($connect, "SELECT * FROM kepek WHERE csereid=$tradeid");
    while($row = mysqli_fetch_array($res))
    {$kepek[]=$row['keputvonal'].$row['kepnev'];}
    return $kepek;
 }
 function keresUserbyFid($fid){
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
     $szemelyes=array();
    $res= mysqli_query($connect, "SELECT * FROM szemelyesadatok WHERE felhasznaloid=$fid");
    while($row = mysqli_fetch_array($res))
    {
    $szemelyes['nev']=$row['lastname']." ".$row['firstname'];
    $szemelyes['varosid']=$row['varosId'];
    $szemelyes['email']=$row['email'];
    $szemelyes['phone']=$row['phone'];
    $szemelyes['address']=$row['address'];
    $szemelyes['regdate']=$row['regdate'];
    $szemelyes['id']=$row['id'];
    }
    return $szemelyes;
 }
 
 function keresUserbyID($szemelyesid){
      $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
     $szemelyes=array();
    $res= mysqli_query($connect, "SELECT * FROM szemelyesadatok WHERE id=$szemelyesid");
    while($row = mysqli_fetch_array($res))
    {
    $szemelyes['nev']=$row['lastname']." ".$row['firstname'];
    $szemelyes['varosid']=$row['varosId'];
    $szemelyes['email']=$row['email'];
    $szemelyes['phone']=$row['phone'];
    $szemelyes['address']=$row['address'];
    $szemelyes['regdate']=$row['regdate'];

    }
    return $szemelyes;
 }
 
 function keresKat($kategoriaid){
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
    
    $res= mysqli_query($connect, "SELECT * FROM kategoria WHERE id=$kategoriaid");
   $row = mysqli_fetch_array($res);
$kategoria=$row['kategoria'];
return $kategoria;
 }
  function keresAllapot($allapotid){
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
    
    $res= mysqli_query($connect, "SELECT * FROM allapot WHERE id=$allapotid");
   $row = mysqli_fetch_array($res);
$allapot=$row['nev'];
return $allapot;
 }
function keresAlkat($alkategoriaid){
     $connect = new mysqli('localhost','root','','tradem','3306');
      $connect->set_charset('utf8');
    
    $res= mysqli_query($connect, "SELECT * FROM alkategoria WHERE id=$alkategoriaid");
   $row = mysqli_fetch_array($res);
$alkategoria=$row['display'];
return $alkategoria;
} 

function keresProfilKep($felhasznaloID){
    $connect=new mysqli('localhost','root','','tradem','3306');
    $connect->set_charset('utf8');
    $res= mysqli_query($connect, "SELECT profilkep FROM szemelyesadatok where felhasznaloid=$felhasznaloID");
    $row= mysqli_fetch_array($res);
    $profil=$row['profilkep'];
    if($profil=="")
    {$profil='IMG/Profile/blank-profile-pic.png';}
    else{$profil="IMG/Profile/".$row['profilkep'];}
    return $profil;
}
function keresVarosId($varosnev)
{$connect = new mysqli('localhost','root','','tradem','3306');
    $connect->set_charset('utf8');   
    $res= mysqli_query($connect, "SELECT id FROM varos WHERE telepulesnev='$varosnev'");
   $row = mysqli_fetch_array($res);  
   $varosid=$row['id'];
return $varosid;
}
function lastSeen($fid)
{$connect = new mysqli('localhost','root','','tradem','3306');
    $connect->set_charset('utf8');   
         $stmt = $connect->prepare("UPDATE szemelyesadatok SET lastseen = CURDATE() WHERE szemelyesadatok.felhasznaloid =?;");
        $stmt->bind_param("i",$fid);
        $stmt -> execute();   
    
}

 