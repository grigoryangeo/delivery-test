<?php

namespace App\Delivery;

use App\Entity\Order;

class Move24Provider
{
    /** @var  ApiInterface */
    protected $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Create delivery
     *
     * @throws \Exception invalid request
     * @return array
     */
    public function createDelivery(Order $order): array
    {
        return $this->api->createDelivery($this->mapOrderToApi($order));
    }

    /**
     * Map Order to api object
     *
     * @param Order $order
     *
     * @return array
     */
    protected function mapOrderToApi(Order $order): array
    {
        $apiOrder = [
            "name"                    => $order->getName(),
            "surname"                 => $order->getSurname(),
            "patronymic"              => $order->getPatronymic(),
            "phone"                   => $order->getPhone(),
            "from[addr]"              => $order->getFromAddress(),
            "from[lat]"               => $order->getFromLatitude(),
            "from[lon]"               => $order->getFromLongitude(),
            "from[contact_name]"      => $order->getFromContactName(),
            "from[contact_phone]"     => $order->getFromContactPhone(),
            "to[addr]"                => $order->getToAddress(),
            "to[lat]"                 => $order->getToLatitude(),
            "to[lon]"                 => $order->getToLongitude(),
            "time_slot[begin]"        => $order->getTimeBegin()->format('Y-m-d\TH:i:sO'),
            "time_slot[end]"          => $order->getTimeEnd()->format('Y-m-d\TH:i:sO'),
            "schema"                  => $order->getSchema(),
            "legal_entity"            => $order->getLegalEntity(),
            "pay_method"              => $order->getPayMethod(),
            "external_id"             => $order->getExternalId(),
            "requirements[tail_lift]" => ($order->getTailLift()) ? 1 : 0,
            "requirements[loaders]"   => $order->getLoaders(),
        ];

        foreach ($order->getProducts() as $index => $product) {
            $apiOrder['products'][$index]["code"]  = $product->getCode();
            $apiOrder['products'][$index]["name"]  = $product->getName();
            $apiOrder['products'][$index]["cost"]  = $product->getCost();
            $apiOrder['products'][$index]["count"] = $product->getCount();
        }

        return $apiOrder;
    }
}
