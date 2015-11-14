<?php

namespace Quicksilver\Application\Delivery;

class PickupRequest
{
    /**
     * @var int
     */
    private $deliveryId;

    /**
     * PickupRequest constructor.
     * @param int $deliveryId
     */
    public function __construct($deliveryId)
    {
        $this->deliveryId = $deliveryId;
    }

    /**
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }
}