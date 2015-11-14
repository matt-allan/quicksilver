<?php

namespace Quicksilver\Application\Delivery;

class DeliverRequest
{
    /**
     * @var int
     */
    private $deliveryId;

    /**
     * @var string
     */
    private $signature;

    /**
     * @param int    $deliveryId
     * @param string $signature
     */
    public function __construct($deliveryId, $signature)
    {
        $this->deliveryId = $deliveryId;
        $this->signature  = $signature;
    }

    /**
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}