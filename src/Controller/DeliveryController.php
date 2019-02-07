<?php

namespace App\Controller;

use App\Delivery\Move24Provider;
use App\Entity\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DeliveryController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request, Move24Provider $apiProvider, ValidatorInterface $validator)
    {
        $order     = new Order();
        $orderForm = $this->createForm(OrderType::class, $order);
        $orderForm->handleRequest($request);
        $apiErrors = "";

        if ($request->isMethod('POST')) {
            if ($orderForm->isSubmitted() && $orderForm->isValid()) {
                $errors = $validator->validate($order);
                if (!count($errors) > 0) {
                    try {
                        $apiProvider->createDelivery($order);
                        return $this->render('delivery/suscess.html.twig', ['form' => $orderForm->createView()]);
                    } catch (\Exception $e) {
                        $apiErrors = $e->getMessage();
                    }
                }
            }
        }

        return $this->render(
            'delivery/index.html.twig',
            [
                'form'      => $orderForm->createView(),
                'apiErrors' => $apiErrors,
            ]
        );
    }
}

?>