<?php
require_once('CONFIG/start.php');
 echo file_get_contents('HTML/header.html');
if(!isLogged())
 {     echo file_get_contents('HTML/menuOut.html'); }
 else{ include'HTML/menuIn.php';}

$html = "";
if (!empty($_GET['item'])){
   
    
    $tradeid = $_GET['item'];     
    ///Képek eltárolva tömbbe+funkció 
    $kepek=keresKepek($tradeid);
    $size= count($kepek);
    //Személyes adatok tömbbe 1.userid lekérése 
         $szemelyes=array();
    $res= mysqli_query($connect, "SELECT DISTINCT userid FROM cserek WHERE csId=$tradeid");
    $row = mysqli_fetch_array($res);
    $uid=$row['userid'];
    //Személyes adatok lekérése userid alapján
         $szemelyes=array();
    $res= mysqli_query($connect, "SELECT * FROM szemelyesadatok WHERE id=$uid");
     $row = mysqli_fetch_array($res);
    $szemelyes['tulajneve']=$row['lastname']." ".$row['firstname'];
      $szemelyes['tulajtelefon']=$row['phone'];
      $szemelyes['tulajemail']=$row['email'];
      $szemelyes['utoljaralatogat']=$row['lastseen'];
      $szemelyes['tulajirsz']=$row['irsz'];
      $city= keresVaros($row['varosId']);
      $szemelyes['tulajvaros']=$city['city'];
      $szemelyes['tulajmegye']=$city['state'];
      
      
        ///Carousel item kitöltés képek alapján
    $towrite1='';
        if($size==0){
            $towrite1='<img class="d-block w-100" src="IMG/proba.jpg" alt="First slide">';
        }else if($size==1){
            $towrite1='  <img class="d-block w-100" src="'.$kepek[0].'" alt="First slide">';
        }else if ($size==2){
            $towrite1=' <div class="carousel-item active">'
    .'  <img class="d-block w-100" src="'.$kepek[0].'" alt="First slide">'
    .'</div>'
    .'<div class="carousel-item">'
    . ' <img class="d-block w-100" src="'.$kepek[1].'" alt="Second slide">'
    .'</div>';
        }
        else if ($size==3)
                {$towrite1=' <div class="w-100 carousel-item active">'
    .'  <img class="d-block w-100" src="'.$kepek[0].'" alt="First slide">'
    .'</div>'
    .'<div class="w-100 carousel-item">'
    . ' <img class="d-block w-100" src="'.$kepek[1].'" alt="Second slide">'
    .'</div>'
    .'<div class="w-100 carousel-item">'
     .' <img class="d-block w-100" src="'.$kepek[2].'" alt="Third slide">'
    .'</div>';}else {
       $towrite1= ' <div class="carousel-item active">'
    .'  <img class="d-block w-100" src="'.$kepek[0].'" alt="First slide">'
    .'</div>'
    .'<div class="carousel-item">'
    . ' <img class="d-block w-100" src="'.$kepek[1].'" alt="Second slide">'
    .'</div>'
    .'<div class="carousel-item">'
     .' <img class="d-block w-100" src="'.$kepek[2].'" alt="Third slide">'
    .'</div>'
   .'<div class="carousel-item">'
     .' <img class="d-block w-100" src="'.$kepek[3].'" alt="Fourth slide">'
    .'</div>';
    }
        //Oldalsáv képnézegető feltöltése
        $towrite2='';
        switch ($size){
            case 0 : $towrite2= '<div class="row m-1 pt-5" style="background-color:white;">'.
               '<div class="col"><a href="#"><img src="IMG/proba.jpg" class="rounded w-100"></a></div></div>';
         break;
       case 1 : $towrite2='<div class="row w-100 p-0 m-0 mt-2" style="background-color:white;">'.
               '<div class="col"><a href="#"><img src='.$kepek[0].' class="rounded w-100"></a></div></div>';
         break;
       case 2 : $towrite2= '<div class="row p-0 m-0 w-100">'
            . '<div class="col m-1 p-1"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="0"><img alt="kep1" src='.$kepek[0].' class="rounded  w-100"></a></div>'
            . '<div class="col m-1 p-1 pr-3"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="1"><img alt="kep2" src='.$kepek[1].' class="rounded w-100"></a></div>'
            . '</div>';
         break;
     case 3 : $towrite2= '<div class="row ml-1 w-100 ">'
            . '<div class="col p-1 ml-1 "><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="0"><img src='.$kepek[0].' class="rounded w-100"></a></div>'
            . '<div class="col p-1 mr-2 "><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="1"><img src='.$kepek[1].' class="rounded w-100"></a></div>'
            . '</div>'
            . '<div class="row w-50 m-2" style="background-color:white;">'
            . '<div class="col p-2 w-100" ><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="2"><img src='.$kepek[2].' class="rounded w-100"></a></div></div>';
         break;
     default  : $towrite2=  '<div class="row ml-1 w-100">'
            . '<div class="col p-1 ml-1"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="0"><img src='.$kepek[0].' class="rounded w-100"></a></div>'
            . '<div class="col p-1 mr-2"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="1"><img src='.$kepek[1].' class="rounded w-100"></a></div>'
            . '</div>'
            . '<div class="row w-100 ml-1" >'
            . '<div class="col p-1 ml-1"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="2"><img src='.$kepek[2].' class="rounded w-100"></a></div>'
            . '<div class="col p-1 mr-2"><a class="carousel-control" href="#carouselExampleIndicators" role="button" data-slide-to="3"><img src='.$kepek[3].' class="rounded w-100"></a></div>'
             . '</div>';
         break;
        }
    
    
     //lekéérdezés alapján details.php kialakítása
    $sql = "SELECT * FROM cserek WHERE csID = ?";
    $stmt = $connect -> prepare($sql);
    $stmt -> bind_param("i", $tradeid);
    $stmt -> execute();
    //$stmt -> store_result();
    $stmt -> bind_result($csID, $kategoriaid, $alkategoriaid, $megnevezes, $allapotid, $ertek,
                         $feltoltesdatuma,$reszletek,$userid,$cserekat,$cserealkat,$csereleiras);
    $stmt -> fetch();
    $kategoria= keresKat($kategoriaid);
    $alkategoria= keresAlkat($alkategoriaid);
    $allapot= keresAllapot($allapotid);
    $html .='<div class="col-md-9 list-group-sm shadow"id="fokep">'
             
           . '<div id="carouselExampleIndicators"class="carousel  minh800  slide" data-ride="carousel" >'
  .'<ol class="carousel-indicators">'
  .carouselType($size)     
  .'</ol>'
  .'<div  class="carousel-inner  ml-2 mt-2">'
   .$towrite1
  .'</div>'
  .'<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">'
   .' <span class="carousel-control-prev-icon" aria-hidden="true"></span>'
    .'<span class="sr-only">Previous</span>'
  .'</a>'
 .' <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">'
  .'  <span class="carousel-control-next-icon" aria-hidden="true"></span>'
   .' <span class="sr-only">Next</span>'
 . '</a>'
.'</div>'
            . '<div class="w-100 mt-5">' 
            . '<h1 align="center" class="pl-2">Érték: '.number_format($ertek, 0, '.', ',').' Ft</h1>'
            . '<div><div class="w-100 bg-dark" align="center"><h5 style="color:white" >Tulajdonságok</h5></div>'
            . '<div class="list-group"><span class="list-group-item"><b>Helység: </b>'.$szemelyes['tulajvaros'].' '.$szemelyes['tulajmegye'].'</span>'
            . '<span class="list-group-item"><b>Kategória: </b>'.$kategoria.''
            . '<span> / '.$alkategoria.' </span></span>'
           . '<p class="list-group-item"><b>Állapot: </b> '.$allapot.'</p>'
            . '</div>'

            . '</div>'
            . '<hr><div><div class="w-100 bg-dark light-grey" align="center"><h5 style="color:white" >Leírás</h5></div>'
            . '</div>'
                . '<p class="">'. $reszletek .'</p>'
               . '<hr><p align="right"><b>Feltöltés dátuma:</b> '. $feltoltesdatuma .'</p>'

            . '</div>'
             . '<hr><div><div class="w-100 bg-dark y" align="center"><h5 style="color:white">Érdeklődés</h5></div>'
            . '<p class="">'. $csereleiras .'</p>'
            . '</div>'
            . '</div>'
            
            . '<div class="col-md-3 p-0 m-0 w-100 list-group shadow"  style="border-left:1px solid;">'
            .'<div class="container light-grey p-0 m-0 w-90" style="min-height:350px; border-bottom:1px solid;">'
            .$towrite2
           . '</div>'
            . '<div class="container p-0 m-0 w-100" align="left" >'
            . '<div class="bg-dark w-100 p-0 m-0" align="center"><h5 class="w-100" style="color:white">Kapcsolatfelvétel</h5></div>'
            . '<p class="p-2  w-100"><span class="font-weight-bold">Felhasználó neve:</span> '.$szemelyes['tulajneve'].'</p>'
            . '<p class="p-2  w-100"><span class="font-weight-bold">Telefonszám:</span>'.$szemelyes['tulajtelefon'].'</p>'
            . '<div class="p-2  w-100"><span class="font-weight-bold">Email:</span> <a href="#" align="right">'.$szemelyes['tulajemail'].'</a></div><br>'
            . '<p class="p-2 w-100"><span class="font-weight-bold">Legutóbb elérhető:</span>'.$szemelyes['utoljaralatogat'].'</p>'
            . '</div>'
           . '</div>';
}

 echo '<div class="container w-100 " style="margin-top:50px;">
    <div id="szures" class="row w-100">';
echo $html;
echo '</div></div>';
echo file_get_contents('html/footer.html');