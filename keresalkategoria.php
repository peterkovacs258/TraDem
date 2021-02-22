<?php
require_once 'CONFIG/start.php';
header('Content-Type: text/html');

if($_SERVER['REQUEST_METHOD']=='POST'&&!empty($_POST['kategoriaid']))
{ 
    
    $return_array=array();
    $kategoriaid=$_POST['kategoriaid'];
    $select='';
    $sql="SELECT alkategoria.display, alkategoria.id FROM alkategoria,kategoria WHERE alkategoria.kategoriaid=kategoria.id AND kategoria.id=$kategoriaid";
    $res=$connect->query($sql);
    
    
    
        
        if(!$res)
        {
            echo 'Hiba';
        }
 else {
          
            while ($row= mysqli_fetch_array($res))
            {
                $id=$row['id'];
                $name=$row['display'];
                
                $return_array[]=array("id"=>$id,"name"=>$name);
            }
            echo json_encode($return_array);
 }
    
}
else {    http_response_code(502);}