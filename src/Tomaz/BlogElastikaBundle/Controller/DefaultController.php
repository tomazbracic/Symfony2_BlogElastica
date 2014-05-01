<?php

namespace Tomaz\BlogElastikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TomazBlogElastikaBundle:Default:index.html.twig', array('name' => $name));
    }
}
