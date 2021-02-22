<?php
require_once ('CONFIG/start.php');

if(!isLogged())
{
if (!empty($_POST['email'])) {
    $email = $_POST['email'];

    if (!empty($_POST['password'])) {
        $pwd = $_POST['password'];
        $sql = "SELECT id, email, password FROM felhasznalo WHERE email = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt -> execute();
        $stmt -> store_result();
        if ($stmt->num_rows == 1) {
         
            
            $stmt->bind_result($id, $emai,$hpassword);
            $stmt->fetch();
               if($pwd==$hpassword||password_verify($pwd,$hpassword))
               {
                  $_SESSION['user'] = array("id"=>$id,"email"=>$email,);
         
        lastSeen($_SESSION['user']['id']);
        
        alertThanMove('Sikeres bejelentkezés','index.php',"success");     
               }
                   
                   
            
        }
 else {
            alert("Helytelen belépési adatok!","error");
            
 }
        }


}
}else{    alertThanMove("Már be vagy jelentkezve!",'index.php',"error");
}
echo file_get_contents('HTML/header.html');
echo file_get_contents("HTML/menuOut.html");

echo file_get_contents('HTML/login.html');
echo file_get_contents('HTML/footer.html');

$connect->close();
