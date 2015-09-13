<?php

namespace DROUSS\BookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Admin controller.
 *
 */
class AdminController extends Controller
{
	public function navAction(){
		return $this->render('DROUSSBookBundle::navadmin.html.twig');
	}
	
	public function footerAction(){
		return $this->render('DROUSSBookBundle::footeradmin.html.twig');
	}
}