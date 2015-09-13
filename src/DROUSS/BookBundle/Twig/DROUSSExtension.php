<?php
namespace DROUSS\BookBundle\Twig;

class DROUSSExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
			new \Twig_SimpleFilter('truncate', array($this, 'truncateFilter')),
			new \Twig_SimpleFilter('clean_extrait', array($this, 'clean_extraitFilter')),
			new \Twig_SimpleFilter('insertSep', array($this, 'insertSep')),
			new \Twig_SimpleFilter('sizeof', array($this, 'fsizeFilter')),
        );
    }

    public function truncateFilter($string, $width, $etc = '...')
    {
		return strlen($string) > $width ? ''.substr($string,0,$width).'-'.substr($string,$width, strlen($string)) : $string;
    }
	
	function fsizeFilter($str)
 {
		$str = substr($str, strpos($str, 'Required'));
   return file_exists($str) ? (round(filesize($str) / (1024*1024), 2)) : '0';
 }
	
	function clean_extraitFilter($string)
{
    // Provides: <body text='black'>
    $string = strip_tags($string, '<br><strong><b><i><em>');
    return $string;
}
	
	public function insertSep($str)
		{
		return str_replace(' ','+', $str);
	}

    public function getName()
    {
        return 'drouss_entension';
    }
}