<nav id="navig" class="navbar navbar-expand navbar-dark">
     <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 ">
              <a class="p-2 navbar-brand" id="Logo" href="index.php">Tra<span id="dem">Dem</span></a>
              
              <ul class="navbar-nav ">
                   <li class="nav-item">    <a class="nav-link" href="personal.php">Saját fiókom</a>     </li>
              </ul>
  

     </div>
     <div class="navbar-collapse collapse order-3 w-50 dual-collapse2 ">
      <ul class="navbar-nav" >
          <li class="nav-item btn btn-dark shadow ml-5"><a class="nav-link" href="makeTrade.php"><h4 style="color:white"><span id="dem">Csere</span> Feladása</h4></a></li>
      </ul>
 </div>
    
     <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 ">
        <ul class="navbar-nav ml-auto">
          <li>
              <form class="form-inline" method="post" action="tradesAll.php">
                <input class="rounded mr-2" style="height:40px;" type="text" name="kereses" id="kerescsere">
            <button class="btn btn-light " type="submit">Keresés</button>
             </form>
            </li>
                <li class="nav-item">    <a class="nav-link" href="kapcsolat.php">Kapcsolat</a>     </li>
             <li class="nav-item">    <a class="nav-link" href="logout.php">Kijelentkezés</a>     </li>
    
        </ul>
    </div>
</nav>
<nav id="navbarNavDisappear" class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
  
  <div class=" navbar-collapse d-flex justify-content-center " >
    <ul class="navbar-nav">
       <li class="nav-item">   
           <a class="nav-link" href="tradesAll.php">Összes csere</a>     </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=1">Autó-motor </a>
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
        <a class="nav-link" href="tradesAll.php?id=4">Játék</a>
      </li>
      <li class="NavItems nav-item">
        <a class="nav-link" href="tradesAll.php?id=10">Sport és fitness</a>
      </li>
    </ul>
  </div>

</nav>

<nav id="navbarNavAppear" class="navbar navbar-expand-sm justify-content-between sticky-top navbar-dark bg-dark">
        
  <div class=" navbar-collapse d-flex justify-content-center " >
      
      <ul class="navbar-nav">
       <li class="nav-item">    <a class="nav-link" href="tradesAll.php">Összes csere</a>     </li>
       <li>
           
           
         <div id="BigDropDownDiv" class="dropdown show">
            <a class=" nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Több
            </a>

            <div id="SmallDropDownDiv" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <a class="nav-link" href="tradesAll.php?id=1">Autó-motor <span class="sr-only">(current)</span></a>
               <a class="nav-link" href="tradesAll.php?id=2">Számítógép</a>
               <a class="nav-link" href="tradesAll.php?id=5">Divat és ruházat</a>
               <a class="nav-link" href="tradesAll.php?id=8">Hobbi</a>
               <a class="nav-link" href="tradesAll.php?id=3">Játék</a>
               <a class="nav-link" href="tradesAll.php">Sport és fitness</a>



            </div>
        </div>
      </ul>
      
  </div>
    
    
</nav>
