<?php
require_once ('CONFIG/start.php');


echo file_get_contents('HTML/header.html');

 if(!isLogged())
 {     echo file_get_contents('HTML/menuOut.html'); }
 else{ include'HTML/menuIn.php';}

 //TODOO Javascript order by
 //echo file_get_contents('html/orderBy.html');
 
 $sql="SELECT * FROM cserek";
 //var_dump($_SERVER['PHP_SELF']);
 //Szűrés ár szerint


 echo '<div class="container w-100" >
    <div id="szures" class="row">';
 //Fő kategóriákra osztás
 //TODO finomítás, sql alapján lekérdezni a kategóriákat
 if(isset($_GET['id'])){
 $id=$_GET['id'];
 switch ($id){
     case 1 : $sql='select * from cserek WHERE kategoriaid="1"';
         break;
     case 2 : $sql='select * from cserek WHERE kategoriaid="2"';
         break;
     case 4 : $sql='select * from cserek WHERE kategoriaid="4"';
     break;
     case 5 : $sql='select * from cserek WHERE kategoriaid="5"';
     break;
     case 6 : $sql='select * from cserek WHERE kategoriaid="6"';
     break;
     case 7 : $sql='select * from cserek WHERE kategoriaid="7"';
     break;
     case 8 : $sql='select * from cserek WHERE kategoriaid="8"';
     break;
     case 9 : $sql='select * from cserek WHERE kategoriaid="9"';
     break;
     case 10 : $sql='select * from cserek WHERE kategoriaid="10"';
     break;
     case 11 : $sql='select * from cserek WHERE kategoriaid="11"';
     break;
     case 20 : $sql='select * from cserek WHERE kategoriaid="2" AND alkategoriaid="16"';
     break;
     case 21 : $sql='select * from cserek WHERE kategoriaid="8" AND alkategoriaid="63"';
     break;
     case 22 : $sql='select * from cserek WHERE kategoriaid="10" AND alkategoriaid="57"';
     break;
     case 23 : $sql='select * from cserek WHERE kategoriaid="4" AND alkategoriaid="18"';
     break;
     case 24 : $sql='select * from cserek WHERE kategoriaid="5" AND alkategoriaid="32"';
     break;
     case 25 : $sql='select * from cserek WHERE kategoriaid="11" AND alkategoriaid="75"';
     break;
 }
 
 }
include 'HTML/szures.php';
 
 
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 // ha nincs kijelölve kategória akkor az összeset kérdezze le
 if(isset($_POST['Kategoriak']))
 { $kategoriak=$_POST['Kategoriak'];
    if($kategoriak==0)
    {
        $sql='select * from cserek WHERE cserek.csID=cserek.csID';
    }else{
             $sql='select * from cserek,kategoria WHERE cserek.kategoriaid=kategoria.id AND kategoria.id="'.$kategoriak.'"';
    }
     
   if(isset($_POST['alkategoriak']))
   {
       $alkategoriak=$_POST['alkategoriak'];
     if($alkategoriak!=0)
     {
         $sql.=' AND cserek.alkategoriaid="'.$alkategoriak.'"';
     }
   }
 }
 //Árkeresés
 $min=0;
 $max=PHP_INT_MAX;
 if(!empty($_POST['min'])||!empty($_POST['max']))
 {
     if(!empty($_POST['min'])){$min=$_POST['min'];}
     if(!empty($_POST['max'])){$max=$_POST['max'];}
     
     $sql.=" AND cserek.ertek BETWEEN $min AND $max";
     
 } //Keresés kulcsszó alapján+Leírásban
if(!empty($_POST['kulcsszo'])) 
{    $kulcsszo=$_POST['kulcsszo'];
    if(empty($_POST['leiras']))
    {//TODOO leírás megjavítása
        $sql.=' AND cserek.megnevezes LIKE "%'.$kulcsszo.'%"';
    }
    else
    {
            $sql.=' AND (cserek.megnevezes LIKE "%'.$kulcsszo.'%" OR  cserek.reszletek LIKE "%'.$kulcsszo.'%")' ;
    }
}


//Állapot keresés
if(isset($_POST['allapot'])){
    $allapot=$_POST['allapot'];
    switch ($allapot){
     case 1 : $sql.=' AND cserek.allapotid="1"';
         break;
     case 2 : $sql.=' AND cserek.allapotid="2"';
         break;
    case 3 : $sql.=' AND cserek.allapotid="3"';
         break;
     case 4 : $sql.=' AND cserek.allapotid="4"';
         break;
     case 5 : $sql.=' AND cserek.allapotid="5"';
         break;
    }
    }
 ///////SZURESVEGE\\\\\\\\\
/////NavBarKERESÉS\\\\\
    if(!empty($_POST['kereses']))
    {       
    $kereses=$_POST['kereses'];
    $sql='SELECT * FROM cserek, alkategoria where cserek.alkategoriaid=alkategoria.id'
            . ' AND  alkategoria.nev LIKE "%'.$kereses.'%" OR cserek.megnevezes LIKE "%'.$kereses.'%"'
            . ' GROUP BY cserek.megnevezes ';
           
    }
    
   
 //////RENDEZÉS\\\\\
    if(isset($_POST['orderAr'])&&isset($_POST['orderNev']))
    {
    $orderar=$_POST['orderAr'];
    $ordernev=$_POST['orderNev'];
    $sql.=" ORDER BY ertek $orderar, megnevezes $ordernev";
    }
    else if(isset($_POST['orderAr']))
    {
     $orderar=$_POST['orderAr'];$sql.=" ORDER BY ertek $orderar";}
    else if(isset($_POST['orderNev']))
    {$ordernev=$_POST['orderNev'];$sql.=" ORDER BY megnevezes $ordernev";}
 }
 else {$sql.=" ORDER BY feltoltesdatuma DESC";}
     /////Rendezés vége\\\\\\


 if(isset($_GET['limit']))
 {$limit=$_GET['limit'];}
 else{ $limit=10;
}
 $start=0;
if(isset($_POST['to']))
{$limit=$_POST['to'];}
    ///Oldal tördelés
 if(isset($_GET['page']))
 {
 $page=$_GET['page'];
 if($page==""&&$page==1)
 {$start=0;}
 else {
    $start=($page*$limit)-$limit;
}
 }
 
 

$res=$connect->query($sql);
$count= mysqli_num_rows($res);
$pageselect=$count/$limit;
$pageselect= ceil($pageselect);

 $sql.=" LIMIT $start,$limit";
 $res=$connect->query($sql);

$cserek='<div class="col csall w-100 mt-5" >';
$cserek.='<form method="post" action="'.$_SERVER['PHP_SELF'].'?limit='.$limit.'" align="right" class="tordelform p-1">
        <span class="ml-2">Hirdetés/oldal</span>

    <input type="submit" name="to" class="btn border bg-light" value="5">
    <input type="submit" name="to" class="btn border bg-light" value="10">
    <input type="submit" name="to" class="border bg-light btn" value="15">
</form>';

if(!$res)
{echo 'Hiba a lekérdezésben!!';}
else{
     if(isset($_POST['megyeSzures'])&&$_POST['megyeSzures']!=0)
     {
         
        $megyeszures=$_POST['megyeSzures'];
         while($row=$res->fetch_assoc())
         {
           $user= keresUserbyID($row['userid']);
           $varosinfo=keresVaros($user['varosid']); 
            $megyeid=$varosinfo['stateID'];
            $artotal =  number_format($row['ertek'], 2, '.', ',');

            
            if($megyeszures==$megyeid)
           {       
               $kepek= keresKepek($row['csID']);
               if(empty($kepek))
               {$kepek[0]="IMG/proba.jpg";}
               
              $user= keresUserbyID($row['userid']);
              $varosinfo=keresVaros($user['varosid']);
           $cserek.= '<div id="kartya" class="card" style="width:100%;" >'
                       . '<img class="card-image-top mt-2" src="'.$kepek[0].'" style="width:25%;margin:auto;">'
                       . '<div class="card-body">'
                       . '<h4 class="card-title" style="text-align:center">'.$row['megnevezes'].'</h4>'
                                          . '<h5 class="card-text"> Érték: '.$artotal.' Ft </h5>'
                   . '<div class="row">'
                   . '<p class="card-text col"> Feltöltve: '.$row['feltoltesdatuma'].'. </p>'
                   . '<span class="card-text col">'.$varosinfo['city'].' '.$varosinfo['state'].' megye</span>'
                       . '</div>'
                   . '<a data-azonosito="'.$row['csID'].'" class="col btn btn-dark " href="#" id="reszletek">Részletek</a>'
                       . '</div>'
                       . '</div>';
           }
           
             
         }

        
     }
     else
     {
        
           while($row=$res->fetch_assoc())
           {$artotal =  number_format($row['ertek'], 0, '.', ',');
                $kepek= keresKepek($row['csID']);
               if(empty($kepek))
               {$kepek[0]="IMG/proba.jpg";}
              $user= keresUserbyID($row['userid']);
              $varosinfo=keresVaros($user['varosid']);
           $cserek.= '<div id="kartya" class="card" style="width:100%;" >'
                       . '<img class="card-image-top mt-2" src="'.$kepek[0].'" style="width:25%;margin:auto;">'
                       . '<div class="card-body">'
                       . '<h4 class="card-title" style="text-align:center">'.$row['megnevezes'].'</h4>'
                                          . '<h5 class="card-text"> Érték: '.$artotal.' Ft </h5>'
                   . '<div class="row">'
                   . '<p class="card-text col"> Feltöltve: '.$row['feltoltesdatuma'].'. </p>'
                   . '<span class="card-text col">'.$varosinfo['city'].' '.$varosinfo['state'].' megye</span>'
                       . '</div>'
                   . '<a data-azonosito="'.$row['csID'].'" class="col btn btn-dark " href="#" id="reszletek">Részletek</a>'
                       . '</div>'
                       . '</div>';
           }
     }
           $cserek.="</div>";
}


echo$cserek;

echo '</div>';
echo"<div style='margin-right: 10%' align='right' ' class='pageSelector col  mt-5'>";
for($i=1;$i<=$pageselect;$i++)
  {      echo '<a class="pages" href="tradesAll.php?page='.$i.'&limit='.$limit.'" ><button class="btn btn-light shadow-sm border col-1 p-2 mr-2">'.$i.'</button></a>';}
   echo '</div>';
echo "</div>";

echo file_get_contents('html/footer.html');
$connect->close();
