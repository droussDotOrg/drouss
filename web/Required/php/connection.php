<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 23/03/2015
 * Time: 12:16
 */

try
{
    $bdd = new PDO('mysql:dbname=drousec5_droussv3;host=localhost;charset=utf8','drousec5','p6H4*sRzXkUc', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


