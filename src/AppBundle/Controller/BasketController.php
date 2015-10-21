<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;

class BasketController extends Controller
{
    /**
     * @Route("/koszyk", name="basket")
     */
    public function indexAction(Request $request)
    {
        $basket = $this->get('basket');
        $quantities = $request->request->get('quantity', []); 
        foreach ($quantities as $id => $quantity) {
            
            $basket->updateQuantity($id, $quantity);
        }

        return $this->render('Basket/index.html.twig', [
            'basket' => $basket,
        ]);
    }

    /**
     * @Route("/koszyk/{id}/dodaj", name="basket_add")
     */
    public function addAction(Request $request, Product $product = null)
    {
        if (is_null($product)) {
            $this->addFlash('danger', 'Produkt, który próbujesz dodać nie został znaleziony!');
            return $this->redirect($request->headers->get('referer'));
        }
        
        try {

            $basket = $this->get('basket');
            $basket->add($product);
          
        } catch (\Exception $e) {
            
            $this->addFlash('danger', $e->getMessage());
            return $this->redirect($request->headers->get('referer'));
        }

        $this->addFlash('success', sprintf('Produkt "%s" został dodany do koszyka', $product->getName()));

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/{id}/usun", name="basket_remove")
     */
    public function removeAction(Product $product)
    {
        $basket = $this->get('basket');

        try {
            $basket->remove($product);

            //$this->addFlash('success', 'Produkt ' . $product->getName() . ' został usunięty z koszyka');
            $this->addFlash('success', sprintf('Product %s został usunięty z koszyka', $product->getName()));

        } catch (\Exception $ex) {

            $this->addFlash('danger', $ex->getMessage());
        }

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/wyczysc", name="basket_clear")
     */
    public function clearAction()
    {
        $this
            ->get('basket')
            ->clear();

        $this->addFlash('success', 'Koszyk został pomyślnie wyczyszczony.');

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/list")
     */
    public function listAction()
    {
        return $this->render('Basket/list.html.twig', [
            'basket' => $this->get('basket'),
        ]);
    }
    
}
