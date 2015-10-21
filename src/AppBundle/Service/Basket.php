<?php namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of Basket
 */
class Basket
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getProducts()
    {
        return $this->session->get('basket', array());
    }

    public function add(Product $product, $quantity = 1)
    {
        if ($product->getAmount() <= 0) {
            throw new \Exception("Produkt, który próbujesz dodać jest już niedostępny!");
        }

        $products = $this->getProducts();

        if (!array_key_exists($product->getId(), $products)) {

            $products[$product->getId()] = array(
                'id' => $product->getId(),
                'slug' => $product->getSlug(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'quantity' => 0
            );
        }

        // aktualizujemy ilość produktów w koszyku
        $products[$product->getId()]['quantity'] += $quantity;

        // zapisujemy dane do sesji
        $this->session->set('basket', $products);

        return $this;
    }
    
    // TODO: przemyśleć czy nie przekazywać produktu zamiast $id
    // TODO: usuwać dla quantity = 0
    public function updateQuantity($id, $quantity)
    {
        $products = $this->getProducts();
        
        // aktualizujemy ilość produktów w koszyku
        $products[$id]['quantity'] = $quantity;
        
        // zapisujemy dane do sesji
        $this->session->set('basket', $products);

        return $this;
    }

    public function remove(Product $product)
    {
        $products = $this->getProducts();

        if (!array_key_exists($product->getId(), $products)) {
            throw new Exception(sprintf('Produkt "%s" nie znajduje się w Twoim koszyku', $product->getName()));
        }

        unset($products[$product->getId()]);

        $this->session->set('basket', $products);

        return $this;
    }

    public function clear()
    {
        $this->session->remove('basket');
        // $this->session->set('basket', array());

        return $this;
    }

    public function getPrice()
    {
        $price = 0;
        foreach ($this->getProducts() as $product) {
            $price += $product['price'] * $product['quantity'];
        }

        return $price;
    }

    public function getQuantity()
    {
        $quntity = 0;
        foreach ($this->getProducts() as $product) {
            $quntity += $product['quantity'];
        }

        return $quntity;
    }
}
