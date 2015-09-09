<?php

namespace DROUSS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DROUSSUserBundle:Default:index.html.twig', array('name' => $name));
    }
		
}
