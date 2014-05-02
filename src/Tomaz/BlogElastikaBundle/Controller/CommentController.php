<?php
// src/Tomaz/BlogElastikaBundle/Controller/CommentController.php

namespace Tomaz\BlogElastikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tomaz\BlogElastikaBundle\Entity\Comment;
use Tomaz\BlogElastikaBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('TomazBlogElastikaBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();
        $comment->setBlog($blog);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('TomazBlogElastikaBundle_blog_show', array(
                    'id' => $comment->getBlog()->getId())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('TomazBlogElastikaBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();

        $blog = $em->getRepository('TomazBlogElastikaBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }

}