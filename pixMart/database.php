<?php


class database
{


    public static $dbms;

    public static function db(){
        if (!isset($dbms)) {
            database::$dbms = new mysqli("localhost", "root","0724886404Was", "eshop", "3306");
        }
    }

    public static function iud($q){
        database::db();
        database::$dbms->query($q);
    }

    public static function s($q){
        database:: db();
       $res=database::$dbms->query($q);
       return $res;
    }
}
?>