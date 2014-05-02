<?php

namespace Tomaz\BlogElastikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tomaz\BlogElastikaBundle\Entity\Enquiry;
use Tomaz\BlogElastikaBundle\Form\EnquiryType;


class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blogs = $em->getRepository('TomazBlogElastikaBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('TomazBlogElastikaBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function aboutAction()
    {
        return $this->render('TomazBlogElastikaBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                // perform some action, such as sending email

                // Redirect - This is important to prevent user re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('TomazBlogElastikaBundle_contact'));
            }
        }

        return $this->render('TomazBlogElastikaBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}