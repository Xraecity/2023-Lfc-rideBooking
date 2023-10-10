<?php

define('DB_DSN', 'mysql:host=us-cluster-east-01.k8s.cleardb.net;dbname=heroku_b4cc250565d2383;charset=utf8');
define('DB_USER','b9cc45b4749d89');
define('DB_PASS','0ec0a262');

try{
    $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    print "Error: " . $e->getMessage();
    die();
}


?>