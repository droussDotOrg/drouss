<?php
/**
 * Created by PhpStorm.
 * User: NDOUR
 * Date: 29/03/2015
 * Time: 21:28
 */
require_once('../../Required/php/connection.php');
session_start();

if((isset($_POST['nom']) && $_POST['nom'] !== "") && (isset($_POST['message']) && $_POST['message'] !== ""))
{
  $input = $_POST["cpres"];
    $flag = $_POST["flag"];
if ($flag == 1){
 $tmp = $_SESSION['captcha_string'];
 /*echo $input;
  echo $_SESSION['captcha_string'];*/
   if ($input == $tmp) // user input and captcha string are same
    {  
       $com = $_POST['message'];
      
$com = preg_replace("#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS","<a href='$0' target='_blank'>$0</a>",$com);
    $req = $bdd->prepare('INSERT INTO commentaire(nom, email, message, categories, date_com) VALUES(:n, :e, :m, "femmes",NOW())');
    $req->execute(array('n' => $_POST['nom'],
                  'e' => $_POST['email'],
                   'm' => $com
    ));
    
    }
 
}
 
}


header('Location:http://www.drouss.org/femmes.php');



//https://mathiasbynens.be/demo/url-regex regex