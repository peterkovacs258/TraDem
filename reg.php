<?php
require_once ('CONFIG/start.php');

$regError="";


if(isLogged())
{    alertThanMove("Már be vagy jelentkezve!", "index.php", "error");}
else
{
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(!empty($_POST['email'])&&!empty($_POST['password'])
            &&!empty($_POST['confirm'])&&!empty($_POST['name']));
    {
        $email=$_POST['email'];
        $pwd=$_POST['password'];
        $pwdc=$_POST['confirm'];
        $vname=$_POST['Vname'];
        $kname=$_POST['Kname'];
        $city=$_POST['city'];
        $address=$_POST['address'];
        $irsz=$_POST['irsz'];
        $phone=$_POST['phone'];
        $vid=keresVarosId($city);
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    
        $regError.=($pwd!=$pwdc)?"A két jelszó nem egyezik meg<br>": "";
        $regError.=(strlen($pwd)<4)?" Túl rövid a jelszó<br>" : "";
     
        
       
        if($regError==""){
          
        //password_verify($password,$row['password']);
        //$pwd= password_hash($pwd, PASSWORD_DEFAULT);
        $sql="INSERT INTO felhasznalo (email,password) VALUES (?,?)";
        $stmt=$connect->prepare($sql);   
        $stmt->bind_param("ss",$email, $hashed_password);
          $stmt->execute();
         //SIKERES REGISZTRÁCIÓ, USERNAME ÉS JELSZÓ FELTÖLTVE
           //A SZEMÉLYES ADATOK FELTÖLTÉSE
           ///FID lekérése
           $sql="SELECT id FROM felhasznalo WHERE email='$email' LIMIT 1";
            $res = $connect-> query($sql);
        if(!$res)
            {echo'baj van';}
        else{
             while($row=$res->fetch_assoc())
                {$fid=$row['id'];}
                 }           
               $sql="INSERT INTO szemelyesadatok (felhasznaloid,lastname,firstname,email,phone,irsz,varosId,address)"
                       . " VALUES(?,?,?,?,?,?,?,?)"; 
            $stmt=$connect->prepare($sql);
            try{
            $stmt->bind_param("isssiiis",
                $fid,$vname,$kname,$email,$phone,$irsz,$vid,$address);
            $stmt->execute();
            }
            catch (Exception $ex)
            {$ex->getTraceAsString();}
            
         alertThanMove("Sikeres regisztráció!", "login.php", "success");
        }
       else{
      }       
       }
    
}
$connect->close();

}
echo file_get_contents('HTML/header.html');
echo file_get_contents('HTML/menuOut.html');
echo file_get_contents('HTML/reg.html');
echo file_get_contents('HTML/footer.html');

