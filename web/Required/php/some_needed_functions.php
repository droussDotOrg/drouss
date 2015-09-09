<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 23/03/2015
 * Time: 12:18
 */
 
 function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}

 
 function cpy($source, $dest){
   set_time_limit(120);
    if(is_dir($source)) {
        $dir_handle=opendir($source);
        while($file=readdir($dir_handle)){
            if($file!="." && $file!=".."){
                if(is_dir($source."/".$file)){
                    if(!is_dir($dest."/".$file)){
                        mkdir($dest."/".$file);
                    }
                    cpy($source."/".$file, $dest."/".$file);
                } else {
                  if(true)
                  {
                    copy($source."/".$file, $dest."/".$file);
                  }
                    
                }
            }
        }
        closedir($dir_handle);
    } else {
      if(true)
      {
        copy($source, $dest);
        
      }
        
    }
}
 
 function fsize($str)
 {
   
   return file_exists($str) ? (round(filesize($str) / (1024*1024), 2)) : '0';
 }

function truncate_extrait($string, $width, $etc = '...')
{
    return truncate($string, $width, $etc = '...');
}

function truncate($string, $width, $etc = '...')
{
    return strlen($string) > $width ? ''.substr($string,0,$width).$etc : $string;
}

function clean_extrait($string)
{
    // Provides: <body text='black'>
    $string = strip_tags($string, '<br><br/><strong><b><i><em>');
    return $string;
}


function range_($min, $max)
{
    $a = array();
    for($i = $min; $i <$max; $i++)
    {
        $a[$i] = $i;
    }

    return $a;
}

function shuffle_($a)
{
    return $a;
}

function remove_dot($string)
{
    return substr($string,13);
}

function remove_dot2($string)
{
    return substr($string,2);
}

function clean_com($str)
{
    return strip_tags($str, '<a></a>');
}

function string_measure_similarity($str_a, $str_b)
{
    $length = strlen($str_a);
    $length_b = strlen($str_b);

    $i = 0;
    $segmentcount = 0;
    $segmentsinfo = array();
    $segment = '';
    while ($i < $length)
    {
        $char = substr($str_a, $i, 1);
        if (strpos($str_b, $char) !== FALSE)
        {
            $segment = $segment.$char;
            if (strpos($str_b, $segment) !== FALSE)
            {
                $segmentpos_a = $i - strlen($segment) + 1;
                $segmentpos_b = strpos($str_b, $segment);
                $positiondiff = abs($segmentpos_a - $segmentpos_b);
                $posfactor = ($length - $positiondiff) / $length_b; // <-- ?
                $lengthfactor = strlen($segment)/$length;
                $segmentsinfo[$segmentcount] = array( 'segment' => $segment, 'score' => ($posfactor * $lengthfactor));
            }
            else
            {
                $segment = '';
                $i--;
                $segmentcount++;
            }
        }
        else
        {
            $segment = '';
            $segmentcount++;
        }
        $i++;
    }

    // PHP 5.3 lambda in array_map
    $totalscore = array_sum(array_map(function($v) { return $v['score'];  }, $segmentsinfo));
    return $totalscore;
}

function name_($str)
{
  
  return preg_replace("/[^A-Za-z0-9 ]/", '', $str);
}

$n = 1;
function gen()
{
  global $n;
  $r = $n;
  $n++;
  return $r;
}

function detectColors($image, $num, $level = 5) {
  $level = (int)$level;
  $palette = array();
  $size = getimagesize($image);
  if(!$size) {
    return FALSE;
  }
  switch($size['mime']) {
    case 'image/jpeg':
      $img = imagecreatefromjpeg($image);
      break;
    case 'image/png':
      $img = imagecreatefrompng($image);
      break;
    case 'image/gif':
      $img = imagecreatefromgif($image);
      break;
    default:
      return FALSE;
  }
  if(!$img) {
    return FALSE;
  }
  for($i = 0; $i < $size[0]; $i += $level) {
    for($j = 0; $j < $size[1]; $j += $level) {
      $thisColor = imagecolorat($img, $i, $j);
      $rgb = imagecolorsforindex($img, $thisColor); 
      $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x33)) * 0x33)), round(round(($rgb['green'] / 0x33)) * 0x33), round(round(($rgb['blue'] / 0x33)) * 0x33));
      $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;  
    }
  }
  arsort($palette);
  return array_slice(array_keys($palette), 0, $num);
}
