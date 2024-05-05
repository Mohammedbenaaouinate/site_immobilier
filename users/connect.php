<?php
        $db="mysql:host=localhost;dbname=immobilier";
        $user="root";
        $password="";
        $option = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        try{
            $con =new PDO($db,$user,$password,$option);
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Failed  To connect into DataBasre'.$e->getMessage();
        }


?>