<?php
try {
    session_start();
    $dbb=new PDO("mysql:host=localhost;dbname=img_db",'root','');
    
} catch (PDOException $e) {
    die('Erreur:'.$e->getMessage());
}

?>