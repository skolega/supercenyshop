<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Orders;
use AppBundle\Entity\OrdersItem;
use AppBundle\Form\OrdersType;

class OrdersController extends Controller
{
    /**
     * @Route("/zamowienie/realizuj", name="orders_create")
     */
    public function createAction(Request $request)
    {
        $basket = $this->get('basket');

        if (empty($basket->getProducts())) {
            $this->addFlash('danger', 'Aby zrealizować zamówienie, musisz posiadać produkty w koszyku');

            return $this->redirectToRoute('basket', []);
        }

        $order = new Orders();
        $form = $this->createForm(new OrdersType(), $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $products = $basket->getProducts();

            $order->setCreatedBy($this->getUser());
            $order->setTotalPrice($basket->getPrice());

            $em->persist($order);

            foreach ($products as $product) {
                $orderItem = new OrdersItem();

                $orderItem->setOrder($order);
                $orderItem->setProductName($product['name']);
                $orderItem->setPrice($product['price']);
                $orderItem->setQuantity($product['quantity']);

                $em->persist($orderItem);
            }

            $em->flush();

            $basket->clear(); // czyścimy koszyk po zamówieniu
            $this->addFlash('success', "Zamówienie zostało dodane i oczekuje na realizację");

            return $this->redirectToRoute('orders_list', []);
        }

        return $this->render('Orders/create.html.twig', [
            'form' => $form->createView(),
            'basket' => $basket,
        ]);
    }

    /**
     * @Route("/zamowienie/moje-zamowienia", name="orders_list")
     */
    public function ordersAction(Request $request)
    {
        $getOrdersQuery = $this->getDoctrine()
            ->getRepository('AppBundle:Orders')
            ->getOrdersQuery($this->getUser());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $getOrdersQuery,
            $request->query->get('page', 1),
            10
        );

        return $this->render('Orders/list.html.twig', [
            'orders' => $pagination,
        ]);
    }

    /**
     * @Route("/zamowienie/szczegoly/{id}", name="orders_show")
     * @Security("user == order.getCreatedBy()")
     */
    public function ordersDetails(Orders $order)
    {
        return $this->render('Orders/details.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/zamowienie/anuluj/{id}", name="orders_cancel")
     * @Security("user == order.getCreatedBy()")
     */
    public function cancelAction(Orders $order)
    {
        if ($order->getStatus() !== Orders::STATUS_NEW) {
            $this->addFlash('danger', 'Zamówienie, które jest w trakcie realizacji bądź zostało już zrealizowane, nie może być anulowane');
        } else {
            $em = $this->getDoctrine()->getManager();
            $order->setStatus(Orders::STATUS_CANCELED);

            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Twoje zamówienie zostało anulowane');
        }

        return $this->redirectToRoute('orders_list', []);
    }
}