<?php

require_once('CONFIG/start.php');
if (!isLogged()) {
    $_SESSION['loginError']="Nincs jogosultságod a cserehírdetés törléséhez!";
    header('Location: index.php');
}
else
{
$fid=$_SESSION['user']['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['id']))) {
   $csid= $_POST['id'];

    $kepek= keresKepek($csid);
    if(count($kepek)!=0)
    {
   $sql="DELETE FROM kepek WHERE csereid=?";
   $stmt=$connect->prepare($sql);
   try {
       $stmt->bind_param("i",$csid);
       $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getTraceAsString();
   }
    }
    
   $sql="DELETE FROM cserek WHERE csID=?";
   $stmt=$connect->prepare($sql);
   try {
       $stmt->bind_param("i",$csid);
       $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getTraceAsString();
        
   }
    
}
}