<?php

// src/Tomaz/BlogElastikaBundle/Controller/BlogController.php

namespace Tomaz\BlogElastikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Blog Controller
 */
class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('TomazBlogElastikaBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find blog post');
        }

        $comments = $em->getRepository('TomazBlogElastikaBundle:Comment')
            ->getCommentsForBlog($blog->getId());

        return $this->render('TomazBlogElastikaBundle:Blog:show.html.twig', array(
            'blog'         => $blog,
            'comments'     => $comments
        ));
    }
}