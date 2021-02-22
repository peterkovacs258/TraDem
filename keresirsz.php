<?php
require_once 'CONFIG/start.php';
header('Content-Type: text/html');
if($_SERVER['REQUEST_METHOD']=='POST'&&!empty($_POST['irsz']))
{ 
    $varosnev='';
   $irszdata=$_POST['irsz'];
   $sql="SELECT * FROM varos WHERE irsz=$irszdata";
   $res= mysqli_query($connect, $sql);
   
   if(mysqli_num_rows($res)>0)
   {
       while($row= mysqli_fetch_array($res))
         {
           $varosnev=$row['telepulesnev'];
         }
         echo trim($varosnev);
   }
   else
   {
       http_response_code(501);
   }
    
}