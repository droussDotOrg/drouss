<?php


namespace DROUSS\BookBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Fza\MysqlDoctrineLevenshteinFunction\DQL\LevenshteinFunction;
use Fza\MysqlDoctrineLevenshteinFunction\DQL\LevenshteinRatioFunction;

/**
 * BookRepository 
 */
class BookRepository extends EntityRepository
{
  public function fff($name)
  {
    
	 $f = strlen($name);
$query = $this->_em->createQuery('SELECT a.title, LEVENSHTEIN_RATIO(SUBSTRING(a.title,1,:len),:name) as dist FROM DROUSSBookBundle:Book a where a.status = 1 order by dist desc')->setParameter('name',$name)
           ->setParameter('len',$f);
  $results = $query->getResult();
	 //print_r($results);
  return array_slice($results, 0, 20);
  }
}