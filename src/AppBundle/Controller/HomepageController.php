<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // pobieramy listę ostatnio dodanych produktów
        $lastProducts = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->getLastAdded();
        
        return $this->render('Homepage/index.html.twig', [
            'products' => $lastProducts,
        ]);
    }

    /**
     * @Route("/set-locale/{locale}", name="set_locale")
     */
    public function setLocaleAction($locale, Request $request)
    {
        $request->getSession()->set('_locale', $locale);

        return $this->redirect($request->headers->get('referer'));
    }
}
