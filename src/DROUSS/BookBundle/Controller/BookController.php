<?php
/**
 * Created by PhpStorm.
 * User: NEGUE BI
 * Date: 29/06/2015
 * Time: 12:33
 */

namespace DROUSS\BookBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use DROUSS\BookBundle\Entity\Publication;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\Mapping\Driver\YamlDriver;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DROUSS\BookBundle\Entity\Author;

use DROUSS\BookBundle\Entity\Book;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;




class BookController extends Controller
{
	public function getDynamicMenu()
	{
		return $this->getDoctrine()->getRepository("DROUSSBookBundle:Category")->findBy([], ['order' => 'asc'],6);
	}
	
	public function trace()
	{
	 $dir = scandir('stat/');
  $nb_visites_total = 0;
  foreach($dir as $fil)
  {
    if (strpos($fil,'nbr') !== false)
    {
      $nb_visites_total += file_get_contents('stat/'.$fil);
    }
  }
//}
file_put_contents('stat/total_page_vue.txt', $nb_visites_total, LOCK_EX);
file_put_contents('stat/last.txt', $nb_visites_total, LOCK_EX);

	
	{
    $file = 'stat/nbr_page_vue_le_'.date('d-m-y').'.txt';
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
		$t = $nb_visites_total;
		$d = $nb_visites_j;
		return [$d,$t];
	}
	public function getDynamicScience()
	{
		return $this->getDoctrine()->getRepository("DROUSSBookBundle:Science")->findAll();
	}
	
	public function getDynamicLanguage()
	{
		return $this->getDoctrine()->getRepository("DROUSSBookBundle:Language")->findAll();
	}
	
	public function searchAction($name)
	{

	$this->trace();
		//$book = $this->getDoctrine()->getRepository("DROUSSBookBundle:Publication")->findOneBy(['title' => $name_]);
		$book = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book")->fff($name);
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$sciences = $this->getDynamicScience();
		
		
		$dicTionary = [
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
						'book'         => $book,
			'search' => $name

		];
        return $this->render('DROUSSBookBundle:Book:search.html.twig', $dicTionary);
	}
	
	public function emailAction(Request $request)
	{
		
		$b = NULL;
		
		if ($request->getMethod() == 'POST') {
			$email = $request->request->get('email');
			$object = $request->request->get('object');
			$message = $request->request->get('message');
		 $m = \Swift_Message::newInstance()
        ->setSubject($object)
        ->setFrom($email)
		->setReplyTo($email)
        ->setTo('moussa_ndour@hotmail.fr')
        ->setBody($message)
    ;
    $b = $this->get('mailer')->send($m);
		}
		if($b)
			{
			$this->get('session')->getFlashBag()->add(
            'sucess',
            'Votre message a bien été Envoyé!'
        );
		}
		else
			{
			$this->get('session')->getFlashBag()->add(
            'danger',
            'Votre message n\'a pas été envoyer. Vueillez reéssayer plus tard Ou nous Contacter a l\'adresse suivante: drouss.org@gmail.com'
        );
		}
		return $this->redirect($this->generateUrl('book_home'));
		//return new Response("");
	}

	public function onlinepubAction($name)
	{
		$this->trace();
		$name_ = str_replace('+',' ', $name);
		
		$book = $this->getDoctrine()->getRepository("DROUSSBookBundle:Publication")->findOneBy(['title' => $name_]);
		if(!$book)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$sciences = $this->getDynamicScience();
		
		
		$dicTionary = [
					   'dynamicMenu'   => $dynamicMenu,
						'pub'         => $book

		];
        return $this->render('DROUSSBookBundle:Book:onlinepub.html.twig', $dicTionary);
	}
	
	
	public function onlineBookAction($name)
	{
		$this->trace();
		$name_ = str_replace('+',' ', $name);
		
		$book = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book")->findOneBy(['title' => $name_]);
		if(!$book)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$sciences = $this->getDynamicScience();
		
		
		$dicTionary = [
					   'dynamicMenu'   => $dynamicMenu,
						'book'         => $book

		];
        return $this->render('DROUSSBookBundle:Book:onlinebook.html.twig', $dicTionary);
	}
	
	
	
    public function indexAction()
    {
		$rep = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book");
		$bookForward = $rep->findBy(['forward' => 1, 'status' => 1]);
		$count = count($rep->findBy(['status' => 1]));
		$count += count($this->getDoctrine()->getRepository("DROUSSBookBundle:Publication")->findAll());
		$tableBook = $rep->findBy(['status' => 1], ['id' => 'desc'],16, 0);
		$tableBook = array_chunk($tableBook,4,true);
		$bookForMobile = $rep->find(rand(150,250));
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$sciences = $this->getDynamicScience();
		$stat = $this->trace();
		$dayPage = $stat[0];
		$totalPage = $stat[1];
		$dicTionary = ['bookForward'    =>   $bookForward,
					   'bookForMobile'  => $bookForMobile,
					   'tableBook'      =>     $tableBook,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
					  'count' => $count,
					   'totalPage' => $totalPage,
					   'dayPage' => $dayPage
		];
        return $this->render('DROUSSBookBundle:Book:index.html.twig', $dicTionary);
    }
	
	public function viewauthorAction($name)
	{
		
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		$name_ = str_replace('+',' ', $name);
		
		$author = $this->getDoctrine()->getRepository("DROUSSBookBundle:Author")->findOneBy(['name' => $name_]);
		if(!$author)
			 throw $this->createNotFoundException("'auteur n'existe pas'");
		$sciences = $this->getDynamicScience();
		$dicTionary = ['author' => $author,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
        return $this->render('DROUSSBookBundle:Book:viewauthor.html.twig', $dicTionary);
	}
	
	public function searchscienceAction(Request $request, $name)
	{
		$this->trace();
		$science =  $this->getDoctrine()->getRepository("DROUSSBookBundle:Science")->findOneBy(['name' => $name]);
		if(!$science)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$results = $science->getBook()->toArray();
		$numberRes = count($results);
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		$sciences = $this->getDynamicScience();
		
		$search_name = $name;
		
		$numberResPerPage = 16;
		$numberPageForResult = ceil(count($results)  /$numberResPerPage);
		$t_p = array();
		for($i = 0; $i < $numberPageForResult; $i++)
		{
    		$t_p[$i] = $i + 1;
		}
		$numberPageForResult = $t_p;
		$page = $request->query->get('page');
		$currentPage = isset($page) ? $page : 1;
		$currentPage = ($currentPage >= 1) ? $currentPage : 1;
		$currentPage = ($currentPage > $numberPageForResult) ? $numberPageForResult : $currentPage;
		$firstInPage = ($currentPage - 1) * $numberResPerPage;
		$lastInPage = $numberResPerPage;
		$results = array_slice($results, $firstInPage, $lastInPage)	;			
		$dicTionary = ['dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
					   'results'       => $results,
					   'numberRes'    => $numberRes,
					   'search_name' => $search_name,
					   'pages' => $numberPageForResult,
		];
        return $this->render('DROUSSBookBundle:Book:searchscience.html.twig', $dicTionary);
	}
	
	public function searchlanguageAction(Request $request, $name)
	{
		$this->trace();
		$science =  $this->getDoctrine()->getRepository("DROUSSBookBundle:Language")->findOneBy(['name' => $name]);
		if(!$science)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$results = $science->getBook()->toArray();
		$numberRes = count($results);
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		$sciences = $this->getDynamicScience();
		
		$search_name = $name;
		
		$numberResPerPage = 16;
		$numberPageForResult = ceil(count($results)  /$numberResPerPage);
		$t_p = array();
		for($i = 0; $i < $numberPageForResult; $i++)
		{
    		$t_p[$i] = $i + 1;
		}
		$numberPageForResult = $t_p;
		$page = $request->query->get('page');
		$currentPage = isset($page) ? $page : 1;
		$currentPage = ($currentPage >= 1) ? $currentPage : 1;
		$currentPage = ($currentPage > $numberPageForResult) ? $numberPageForResult : $currentPage;
		$firstInPage = ($currentPage - 1) * $numberResPerPage;
		$lastInPage = $numberResPerPage;
		$results = array_slice($results, $firstInPage, $lastInPage)	;			
		$dicTionary = ['dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
					   'results'       => $results,
					   'numberRes'    => $numberRes,
					   'search_name' => $search_name,
					   'pages' => $numberPageForResult,
		];
        return $this->render('DROUSSBookBundle:Book:searchlanguage.html.twig', $dicTionary);
	}
	
	public function viewpubAction($name)
	{
		$this->trace();
		$name_ = str_replace('+',' ', $name);
		$book = $this->getDoctrine()->getRepository("DROUSSBookBundle:Publication")->findOneBy(['title' => $name_]);
		if(!$book)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$rand = rand(1,20);
		$sugestes = $this->getDoctrine()->getRepository("DROUSSBookBundle:Publication")->findBy([],[],4,$rand);
		$sciences = $this->getDynamicScience();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		$dicTionary = ['book' => $book,
					   'sugestes' => $sugestes,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
        return $this->render('DROUSSBookBundle:Book:viewpub.html.twig', $dicTionary);
	}
	
	public function listauthorAction()
	{
		$this->trace();
		$author = $this->getDoctrine()->getRepository("DROUSSBookBundle:Author")->findBy(['Oumma' => false],['name' => 'asc']);
		$sciences = $this->getDynamicScience();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$dicTionary = ['author' => $author,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
        return $this->render('DROUSSBookBundle:Book:listauthor.html.twig', $dicTionary);
	}
	
	public function oummaAction(Request $request)
	{
		$this->trace();
				$cat = $this->getDoctrine()->getRepository("DROUSSBookBundle:Category")->findOneBy(['categoryName' => 'Umma']);
		if(!$cat)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$rep = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book");
		
		$numberResPerPage = 16;
		$numberPageForResult = ceil(count($rep->findBy(['status' => 1, 'category' => $cat->getId()])) /$numberResPerPage);
		$t_p = array();
		for($i = 0; $i < $numberPageForResult; $i++)
		{
    		$t_p[$i] = $i + 1;
		}
		$numberPageForResult = $t_p;
		$page = $request->query->get('page');
		$currentPage = isset($page) ? $page : 1;
		$currentPage = ($currentPage >= 1) ? $currentPage : 1;
		$currentPage = ($currentPage > $numberPageForResult) ? $numberPageForResult : $currentPage;
		$firstInPage = ($currentPage - 1) * $numberResPerPage;
		$lastInPage = $numberResPerPage;
		
		
		
		$sciences = $this->getDynamicScience();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		
		$tableBook = $rep->findBy(['status' => 1, 'category' => $cat->getId()], ['id' => 'desc'], $lastInPage, $firstInPage);
		$tableBook = array_chunk($tableBook,4,true);
		
		$dicTionary = ['tableBook' => $tableBook,
					  'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					  'pages' => $numberPageForResult,
					   'sciences'      => $sciences,
		];
		return $this->render('DROUSSBookBundle:Book:oumma.html.twig', $dicTionary);
	}
	
	public function womanAction()
	{
		$this->trace();
		//$author = $this->getDoctrine()->getRepository("DROUSSBookBundle:Author")->findBy(['Oumma' => false],['name' => 'asc']);
		$sciences = $this->getDynamicScience();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$dicTionary = [//'author' => $author,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
        return $this->render('DROUSSBookBundle:Book:woman.html.twig', $dicTionary);
	}
	
	public function viewAction($name)
	{
		$this->trace();
		$name_ = str_replace('+',' ', $name);
		$rep = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book");
		$book = $rep->findOneBy(['title' => $name_]);
		if(!$book)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$init = rand(1,count($rep->findBy(['status' => 1])) - 5);
		$sugestes = $rep->findBy(['status' => 1],['id' => 'desc'],4,$init);
		$sciences = $this->getDynamicScience();
		
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		$dicTionary = ['book' => $book,
					   'sugestes' => $sugestes,
					   'dynamicMenu' => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
		
		return $this->render('DROUSSBookBundle:Book:view.html.twig', $dicTionary);
	}
	
	public function quranAction()
	{
		$this->trace();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		$sciences = $this->getDynamicScience();
		$dicTionary = ['dynamicMenu' => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'sciences'      => $sciences,
		];
		
        return $this->render('DROUSSBookBundle:Book:quran.html.twig', $dicTionary);
	}
	
	public function listpublicationAction(Request $request)
	{
		$this->trace();
		$rep = $this->getDoctrine()->getRepository("DROUSSBookBundle:Publication");
		$numberResPerPage = 16;
		$numberPageForResult = ceil(count($rep->findAll()) /$numberResPerPage);
		$t_p = array();
		for($i = 0; $i < $numberPageForResult; $i++)
		{
    		$t_p[$i] = $i + 1;
		}
		$numberPageForResult = $t_p;
		$page = $request->query->get('page');
		$currentPage = isset($page) ? $page : 1;
		$currentPage = ($currentPage >= 1) ? $currentPage : 1;
		$currentPage = ($currentPage > $numberPageForResult) ? $numberPageForResult : $currentPage;
		$firstInPage = ($currentPage - 1) * $numberResPerPage;
		$lastInPage = $numberResPerPage;
		
		$tableBook = $rep->findBy([], ['id' => 'desc'], $lastInPage, $firstInPage);
		$tableBook = array_chunk($tableBook,4,true);
		$dynamicMenu = $this->getDynamicMenu(); 		
			$dynamicLanguage = $this->getDynamicLanguage();
		$sciences = $this->getDynamicScience();
		$dicTionary = ['tableBook' => $tableBook,
					   'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					   'pages' => $numberPageForResult,
					   'sciences'      => $sciences,
		];
		
        return $this->render('DROUSSBookBundle:Book:listpublication.html.twig', $dicTionary);
	}
	
	public function listAction(Request $request, $category)
	{
		$this->trace();
		$cat = $this->getDoctrine()->getRepository("DROUSSBookBundle:Category")->findOneBy(['categoryName' => $category]);
		if(!$cat)
			 throw $this->createNotFoundException("Le livre n'existe pas");
		$rep = $this->getDoctrine()->getRepository("DROUSSBookBundle:Book");
		
		$numberResPerPage = 16;
		$numberPageForResult = ceil(count($rep->findBy(['status' => 1, 'category' => $cat->getId()])) /$numberResPerPage);
		$t_p = array();
		for($i = 0; $i < $numberPageForResult; $i++)
		{
    		$t_p[$i] = $i + 1;
		}
		$numberPageForResult = $t_p;
		$page = $request->query->get('page');
		$currentPage = isset($page) ? $page : 1;
		$currentPage = ($currentPage >= 1) ? $currentPage : 1;
		$currentPage = ($currentPage > $numberPageForResult) ? $numberPageForResult : $currentPage;
		$firstInPage = ($currentPage - 1) * $numberResPerPage;
		$lastInPage = $numberResPerPage;
		
		
		
		$sciences = $this->getDynamicScience();
		$dynamicMenu = $this->getDynamicMenu(); 		
		$dynamicLanguage = $this->getDynamicLanguage();
		
		
		$tableBook = $rep->findBy(['status' => 1, 'category' => $cat->getId()], ['id' => 'desc'], $lastInPage, $firstInPage);
		$tableBook = array_chunk($tableBook,4,true);
		
		$dicTionary = ['tableBook' => $tableBook,
					  'dynamicMenu'   => $dynamicMenu,
					   'languages' => $dynamicLanguage,
					  'pages' => $numberPageForResult,
					   'sciences'      => $sciences,
		];
		return $this->render('DROUSSBookBundle:Book:list.html.twig', $dicTionary);
	}
}


