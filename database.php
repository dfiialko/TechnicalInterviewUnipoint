<?php
define('DB_DSN','mysql:host=localhost;dbname=unipoint;charset=utf8');
define('DB_USER','denys');
define('DB_PASS','kbxbyuf');
try{
    $db = new PDO(DB_DSN,DB_USER,DB_PASS);
    }
catch(PDOException $e)
    {
        print "Error".$e;
        die();
    }
?>