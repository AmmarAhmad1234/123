<?php


   define("dsn", 'mysql:host=localhost;dbname=ammar');
   define("username", 'root');
   define("password", '');

    try
    {
        // $conn = new PDO('mysql:host=localhost;dbname=ammar','root',' ');
        $conn = new PDO(dsn, username, password);
        echo "connected successfully";
        
    }
    
    catch(PDOException $e){
        echo $e -> getMessage();
    }


?>