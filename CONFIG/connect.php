<?php
$connect = new mysqli('localhost','root','','tradem','3306');
if ($connect -> errno){
    die('Sikertelen csatlakozás az adatbázishoz');
}
if (!$connect ->set_charset('utf8')){
    echo 'A karakterkódolást nem sikerült beállítani!';
}

