

<form  id=szuresphp class="col-md-3 mt-5 list-group" style="min-width: 320px;" method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
    
    <div class="list-group-item">
                <label class="pr-3">Ár szerint </label>
        <span>&#8615;</span> <input type="radio" name="orderAr" value="DESC">
        <span>&#8613;</span> <input  type="radio" name="orderAr" value="ASC" class="mr-5"><br>
  
        <label>Név szerint </label>
        <span>&#8615;</span> <input type="radio" name="orderNev" value="DESC">
        <span>&#8613;</span> <input type="radio" name="orderNev" value="ASC">
        
    </div>
    
        <div class="list-group-item">
            <h6>Érték</h6>
            <input type="text" name="min" size="8" placeholder="MIN" ><span>&nbsp;-</span>
            <input type="text" name="max" size="8" placeholder="MAX">
            <div id="pricerangeDiv"></div>
            
        </div>
            
            
        <div class='list-group-item list'>
            <input type="text" placeholder="Kulcsszó" id="kulcsszo" name="kulcsszo"><br>
            <input type="checkbox" value="Leiras" name="leiras"><label>Leírásban is </label><br><br>

            <label>Főkategória</label>
        <select id="kategoriaid" name="Kategoriak" >
      <option value="0"></option>
      <option value="1">Autó-Motor</option>
      <option value="2">Számítógép</option>     
      <option value="4">Játék</option>     
      <option value="8">Műszaki cikk</option>     
      <option value="7">Háztartás</option>     
      <option value="5">Divat, ruha</option>     
      <option value="10">Sport,és fitness</option>     
      <option value="11">Otthon, kert</option>     
      <option value="9">Irodatechnika</option>     
      <option value="6">Hobbi</option>     

        </select><br>
        <div id="alkategoriaDIV" style="display:none">
        <label>Alkategória</label>
        <select  class="alkategoriak" name="alkategoriak">
            <option id="alkategoriaid" value="0"></option>
            </select>
        </div>
            </div>
           
   
           
        <div class="list-group-item">
             <h6>Állapot</h6>
    <p><input type="radio" name="allapot" value="5">Használt</p>
    <p><input type="radio" name="allapot" value="4">Megkímélt</p>
    <p><input type="radio" name="allapot" value="2">Újszerű</p>
    <p><input type="radio" name="allapot" value="3">Kitűnő</p>
    <p><input type="radio" name="allapot" value="1">Új</p>
        </div>
        
    <div class="list-group-item">
        <h6>Régió</h6>
        <label>Megye</label>
        <select name="megyeSzures">
      <option value="nincs"></option>     
      <option value="0">Budapest</option>     
      <option value="1">Bács-Kiskun</option>     
      <option value="2">Baranya</option>     
      <option value="3">Békés</option>     
      <option value="4">Borsod-Abaúj-Zemplén</option>     
      <option value="5">Csongrád</option>     
      <option value="6">Fejér</option>     
      <option value="7">Győr-Moson-Sopron</option>     
      <option value="8">Hajdú-Bihar</option>     
      <option value="9">Heves</option>     
      <option value="10">Jász-Nagykun-Szolnok</option>     
      <option value="11">Komárom-Esztergom</option>     
      <option value="12">Nógrád</option>     
      <option value="13">Pest</option>     
      <option value="14">Somogy</option>     
      <option value="15">Szabolcs-Szatmár-Bereg</option>     
      <option value="16">Tolna</option>     
      <option value="17">Vas</option>     
      <option value="18">Veszprém</option>     
      <option value="19">Zala</option>     
        </select>
        
      <!--  <label class="pr-3">Város</label><input  type="text" name="varosSzures" placeholder="Város"> -->
    </div>
    
        <button  class="btn btn-danger">Keresés</button>  
       
            
    
</form>

