<?php

require_once('CONFIG/start.php');
if (!isLogged()) {
    header('Location: index.php');
}
header('Content-type: html/text');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['uid']))&&(!empty($_POST['eemail']))) {
    $id=$_POST['uid'];
    $email=$_POST['eemail'];
    $error=false;
   $res= mysqli_query($connect, "SELECT email FROM felhasznalo");
   while($row = mysqli_fetch_array($res))
   {if($email==$row['email'])
   {     $error=true;
   }       
   }
   if($error==true)
   {  http_response_code(501);}
   else
   {
   
    
 $sql="UPDATE felhasznalo set email=? where id=?";
 $sql2="UPDATE szemelyesadatok set email=? where felhasznaloid=?";
 
   $stmt = $connect -> prepare($sql);
    if ($connect -> errno) {
        http_response_code(502);
    } else {
        $stmt->bind_param("si", $email, $id);
        if ($stmt->execute()) {
               $stmt = $connect -> prepare($sql2);
               if($connect->errno)
               { http_response_code(502);}
               else{
                           $stmt->bind_param("si", $email, $id);
        if ($stmt->execute()) {
            echo'siker';
        }
        else{            echo 'nem siker';}
               }
            //siker
            echo 'Siker';
        } else {
            //hiba
            http_response_code(503);
            echo 'Hiba';
        }
    }
    
}
}
$connect->close();