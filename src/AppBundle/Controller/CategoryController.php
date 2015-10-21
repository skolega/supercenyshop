<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->getCategories();

        return $this->render('Category/list.html.twig', [
            'categories' => $categories,
        ]);
    }

}
