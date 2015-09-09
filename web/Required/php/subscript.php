<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 24/03/2015
 * Time: 00:16
 */

require_once('connection.php');

if(isset($_POST['email']) && $_POST['email'] != "")
{
  try{
     $r = $_POST['email'];
    $req = $bdd->prepare('INSERT INTO abonnes(idAbonnes, email) VALUES(NULL,:e)');
    
$req->execute(array('e' => $r));
    
  }
 catch(Exception $e)
{
        header('Location:http://www.drouss.org');
}
 
}

header('Location:http://www.drouss.org');