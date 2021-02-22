<?php
require_once ('CONFIG/start.php');



echo file_get_contents('HTML/header.html');
if(isLogged())
{
    include'HTML/menuIn.php';
}
else
{echo file_get_contents('HTML/menuout.html');}
echo file_get_contents('HTML/kapcsolat.html');

echo file_get_contents('HTML/footer.html');

$connect->close();
