<?php

function connection(){
    try{
        $db = new PDO ('mysql:host='.LOCALHOST.';dbname='.DBNAME.';charset=utf8', DBID, DBMDP);
        return $db;
    } catch(Exception $e){
        die('Erreur de connexion à la base de données:'. $e->getMessage());
    }
}