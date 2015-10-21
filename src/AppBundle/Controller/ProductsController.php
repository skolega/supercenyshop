<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Product;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller
{
    /**
     * @Route("/produkty/{id}", name="products_list", defaults={"id" = false}, requirements={"id": "\d+"})
     */
    public function indexAction(Request $request, Category $category = null)
    {
        $getProductsQuery = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->getProductsQuery($category);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $getProductsQuery,
            $request->query->get('page', 1),
            8
        );

        return $this->render('Products/index.html.twig', [
            'products' => $pagination,
        ]);
    }
    
    /**
     * @Route("/produkt/{slug}", name="product_show")
     */
    public function showAction(Product $product, Request $request)
    {
        // pobieramy aktualnie zalogowanego użytkownika
        $user = $this->getUser();
        
        // tworzymy nowy komentarz
        $comment = new Comment();
        // przypisujemy produkt do komentarza
        $comment->setProduct($product);
        // przypisuje zalogowanego użytkownika do komentarz
        $comment->setUser($user);
        
        $form = $this->createForm(new CommentType(), $comment);
        
        // przetwarzamy dane wysłane z formularza - jeśli jakieś dane zostały wysłane
        $form->handleRequest($request);
        
        // jeśli formularz został wysłane, a użytkownik nie jest zalogowany
        if ($form->isSubmitted() && !$user) {
            $this->addFlash('danger', "Aby móc dodawać komentarze musisz się wcześniej zalogować.");
            return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }
        
        // jeśli formularz został wysłane i wszystkie wprowadzone dane sa poprawne
        if ($form->isValid()) {
            
            // jeśli użytkownik posiada uprawnienia administratora
            if ($user->hasRole('ROLE_ADMIN')) {
                // oznaczamy komentarz jako zweryfikowany
                $comment->setVerified(true);
            }
            
            // pobieramy EntityManager
            $em = $this->getDoctrine()->getManager();
            // zapisujemy komentarz do bazy danych
            $em->persist($comment);
            $em->flush();
            
            // jeśli użytkownik posiada uprawnienia admina
            if ($user->hasRole('ROLE_ADMIN')) {
            // if ($user->isAdmin()) {
                $this->addFlash('success', "Komentarz został pomyślnie zapisany i opublikowany");
            } else {
                $this->addFlash('success', "Komentarz został pomyślnie zapisany i oczekuje na weryfikacje");
            }
            
            return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }
        
        return $this->render('Products/show.html.twig', [
            'product'   => $product,
            'form'      => $form->createView()
        ]);
    }
    
    /**
     * @Route("/szukaj", name="product_search")
     */
    public function searchAction(Request $request)
    {
        $data = $request->query->get('query');
        $pagination = null;
        
        if ($data == '') {
            $this->addFlash('danger', 'Aby wyszukać produkty, musisz wpisać jakąś frazę');
        } else {
            $getProductsQuery = $this->getDoctrine()
                ->getRepository('AppBundle:Product')
                ->searchProductsQuery($data);

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $getProductsQuery,
                $request->query->get('page', 1),
                8
            );
        }

        return $this->render('Products/search.html.twig', [
            'products' => $pagination,
            'query' => $data,
        ]);

    }

}