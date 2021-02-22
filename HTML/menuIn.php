<?php
require_once 'CONFIG/start.php';
$pic= keresProfilKep($_SESSION['user']['id']);
echo '<nav class="navbar navbar-expand navbar-dark">
     <div  class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 pr-0 mr-0">
         <a class=" pl-3 navbar-brand" id="Logo" href="index.php">Tra<span id="dem">Dem</span></a>
         <a href="personal.php" class="kapcsolat"><img class=" menuin rounded" src="'.$pic.'"></a>
         <ul class="navbar-nav">
            <li class="sajat nav-item ml-2 ">    <a class="nav-link" href="personal.php">Saját fiókom<span></span></a>     </li>   
            <li class="nav-item ">    <a class="nav-link" href="logout.php">Kijelentkezés<span></span></a>   </li>        
         </ul>
     </div>
   <div  class="navbar-collapse collapse w-50 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
            <li class="nav-item ">    <a class="nav-link" href="makeTrade.php">Hírdetésfeladás<span></span></a>   </li>        
           <li class="nav-item kapcsolat" >    <a class="nav-link" href="kapcsolat.php">Kapcsolat<span></span></a>     </li>
         </ul>
       
              <form class="navform form-inline" method="post" action="tradesAll.php">
                <ul class="navbar-nav ml-auto">
               <li class="nav-item"> <input class="rounded mr-2 nav-item mt-2 " type="text" name="kereses" id="kerescsere"></li>
               <li class="nav-item"> <button class="btn btn-light nav-item " type="submit">Keresés</button></li>
                </ul>
</form>
     
  </div>
</nav>
<nav id="navbarNavDisappear" class="navbar navbar-expand navbar-light sticky-top">
  
  <div class=" navbar-collapse d-flex justify-content-center " >
    <ul class="navbar-nav">
       <li class="nav-item">    <a class="nav-link" href="tradesAll.php">Összes csere</a>     </li>
 
      <li class="NavItems nav-item" id="csereOsszes">
        <a class="nav-link" href="tradesAll.php?id=1">Autó-motor</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=2">Számítógép</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=8">Műszaki cikk</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=5">Divat és ruházat</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=6">Hobbi</a>
      </li>
       <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=11">Otthon, kert</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=4">Játék</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=10">Sport és fitness</a>
      </li>
    </ul>
  </div>

</nav>

<nav id="navbarNavAppear" class="navbar navbar-expand navbar-light justify-content-between w-100 sticky-top">
  <div class="row navbar-collapse d-flex justify-content-center " >
      
   <ul class="navbar-nav col">
     <li class="nav-item">    <a class="nav-link" href="tradesAll.php">Összes csere</a>     </li>
     <li>
           
           
         <div id="BigDropDownDiv" class="dropdown show">
            <a class=" nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategóriák
            </a>
             <div id="SmallDropDownDiv" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <a class="nav-link" href="tradesAll.php?id=1">Autó-motor <span class="sr-only">(current)</span></a>
               <a class="nav-link" href="tradesAll.php?id=2">Számítógép</a>
               <a class="nav-link" href="tradesAll.php?id=5">Divat és ruházat</a>
               <a class="nav-link" href="tradesAll.php?id=6">Hobbi</a>
               <a class="nav-link" href="tradesAll.php?id=11">Otthon,kert</a>
               <a class="nav-link" href="tradesAll.php?id=7">Háztartás</a>
               <a class="nav-link" href="tradesAll.php?id=3">Játék</a>
               <a class="nav-link" href="tradesAll.php">Sport és fitness</a>
            </div>
        </div>
        </li>
      </ul>
 <form class="col form-inline ml-5" method="post" action="tradesAll.php">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"> <input class="rounded mr-2 nav-item " style="height:40px;" type="text" name="kereses" id="kerescsere"></li>
      <li class="nav-item"> <button class="btn btn-light nav-item " type="submit">Keresés</button></li>
    </ul>
</form>
  </div>
    
    
</nav>
'
?>
                      