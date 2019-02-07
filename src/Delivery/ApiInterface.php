<?php

namespace App\Delivery;

interface ApiInterface
{
    /**
     * Get schemas
     *
     * @return array
     */
    public function getSchemas(): array;

    /**
     * Create delivery
     *
     * @param $delivery - delivery data
     *
     * @return array
     */
    public function createDelivery(array $delivery): array;
}
