<?php
include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(array('templates','reader/turnjs4/samples/magazine'));
$twig = new Twig_Environment($loader, array('cache' => true, 'debug' => true));