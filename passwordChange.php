<?php
require_once ('CONFIG/start.php');


if (isLogged()) {
    if(isset($_POST['pwdsubmit'])&&!empty($_POST['oldpwd'])&&!empty($_POST['newpwd'])&&!empty($_POST['newpwdc'])){
       $id=$_SESSION['user']['id'];
       $oldpwd=$_POST['oldpwd'];
       $newpwd=$_POST['newpwd'];

        $sql = "SELECT password FROM felhasznalo WHERE id=?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt -> execute();
        $stmt -> store_result();
        if ($stmt->num_rows == 1) {
          
            $stmt->bind_result($oldpwddb);
            $stmt->fetch();
            if(!password_verify($oldpwd,$oldpwddb))
            { 
                alert("Nem egyezik a régi jelszava", "error");
            }
            else if($newpwd!=$_POST['newpwdc'])
                {
              alert("A két jelszó nem egyezik meg!", "error");
                }
                else{
                    //$sql="UPDATE felhasznalo SET 'password' = ? WHERE 'felhasznalo'.'id' = ?;";
                    $sql="UPDATE felhasznalo SET password = ? WHERE id = ?;";
                     $stmt = $connect->prepare($sql);
                 $stmt->bind_param("si",$newpwd,$id);
                 $stmt -> execute();
                alertThanMove("Sikeres jelszó változtatás", "personal.php","success");
                }
            
        //alertThanMove("Új jelszó sikeresen beállítva!", "personal.php");        
        }
        else{            alert('HIBA (lekérdezés)','error');}
}
}
 else {
          alertThanMove('Jelentkezz be jelszó váltáshoz!','login.php','error');
           
 }
        



echo file_get_contents('HTML/header.html');
include "HTML/menuIn.php";
echo file_get_contents('HTML/passwordchange.html');
echo file_get_contents('HTML/footer.html');

$connect->close();
