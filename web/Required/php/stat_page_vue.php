<?php
/**
 * Created by PhpStorm.
 * User: NDOUR
 * Date: 30/03/2015
 * Time: 17:59
 */
{
  /*$nb_visites_total = file_get_contents('Required/php/stat/total_page_vue.txt');
$nb_visites_total++;
$b = 170000;
if($nb_visites_total < $b)
{
  $nb_visites_total = file_get_contents('Required/php/stat/last.txt');
  $nb_visites_total++;
}

if($nb_visites_total < $b)
{*/
  $dir = scandir('Required/php/stat/');
  $nb_visites_total = 0;
  foreach($dir as $fil)
  {
    if (strpos($fil,'nbr') !== false)
    {
      $nb_visites_total += file_get_contents('Required/php/stat/'.$fil);
    }
  }
//}
file_put_contents('Required/php/stat/total_page_vue.txt', $nb_visites_total, LOCK_EX);
file_put_contents('Required/php/stat/last.txt', $nb_visites_total, LOCK_EX);
}


{
    $file = 'Required/php/stat/nbr_page_vue_le_'.date('d-m-y').'.txt';
    if(!file_exists($file))
    {
      
        $c = fopen($file, 'w');
        fclose($c);
        file_put_contents($file, '0', LOCK_EX);
    }

    $nb_visites_j = file_get_contents($file);
    $nb_visites_j++;
    file_put_contents($file, $nb_visites_j, LOCK_EX);
}


$domaine_name = 'http://www.drouss.org';