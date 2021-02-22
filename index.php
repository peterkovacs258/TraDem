<?php
require_once 'CONFIG/start.php';
echo file_get_contents('HTML/header.html');
if (isLogged())
{
           include "HTML/menuIn.php";                
}
 else
        {
              echo file_get_contents("HTML/menuOut.html");
                      //  echo '<h2 id="notLogged">A hírdetések megtekintéséhez kérem jelentkezzen be!</h2>';
        }
       
        $html=file_get_contents('HTML/index.html');
        
       $kepekfriss=array();
       $sql="SELECT * from kepek,cserek where kepek.csereid=cserek.csID group by cserek.megnevezes ORDER BY cserek.feltoltesdatuma DESC LIMIT 3";
        $res= mysqli_query($connect, $sql);
        while($row= mysqli_fetch_array($res))
        {
           $html.='<div class="box rounded legfrissebbDiv ">
           <div>
           <a href="details.php?item='.$row['csID'].'"> <img " src="'.$row['keputvonal'].$row['kepnev'].'" class=" legfrissebbCserek" "></a>
            <h5 >'.$row['megnevezes'].'</h3>
                 <h6 >'.$row['ertek'].'Ft</h5>
                 </div>
        </div>';
        }
       
        $html.= 
        '
        </div>
        </section>
        
        <div id="" >
            <section id="kategoriak">
               
                <div id="KatContainer" >
                    
                    <div class="catDiv">
                    <a href="tradesAll.php?id=20" ><img class="w-25 kerek shadow p-3 mb-3 bg-white" src="IMGsite/categories/xbox-1602822_640.jpg" alt="konzol"></a>
                        <a href="tradesAll.php?id=21"><img class="w-25 kerek shadow p-3 mb-3 bg-white" src="IMGsite/categories/hordozhatohangfal.jpg" alt="hangfal"></a>
                             <a href="tradesAll.php?id=22"><img class="w-25 kerek shadow p-3 mb-3 bg-white" src="IMGsite/categories/gorkorcsolya.jpg" alt="görkorcsolya"></a>
                    <div class="catDiv">
                       <a href="tradesAll.php?id=23"><img class="w-25 kerek shadow p-3 mb-3 bg-white" src="IMGsite/categories/pluss.jpg" alt="plüss"></a>
                       <a href="tradesAll.php?id=24"><img class="w-25 kerek shadow p-2 mb-3 bg-white" src="IMGsite/categories/noitaskak.jpg" alt="Női táskák"></a>
                       <a href="tradesAll.php?id=25"><img class="w-25 kerek shadow p-3 mb-3 bg-white" src="IMGsite/categories/konyha.jpg" alt="Konyhai felszerelés"></a>
                    </div>
                        
                               
                </div>
        
            </section>
        </div>
        ';
        echo $html;
        
        
echo file_get_contents('HTML/footer.html');

$connect->close();