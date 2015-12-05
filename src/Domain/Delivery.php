<?php

namespace Quicksilver\Domain;

use Quicksilver\Application\Exceptions\InvalidRequestException;

class Delivery
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Address
     */
    private $pickup;

    /**
     * @var Address
     */
    private $destination;

    /**
     * @var Customer
     */
    private $requester;

    /**
     * @var Delivery\Priority
     */
    private $priority;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var Delivery\Status
     */
    private $status;

    /**
     * Delivery constructor.
     * @param Address  $pickup
     * @param Address  $destination
     * @param Customer $requester
     * @param Delivery\Priority $priority
     */
    public function __construct(Address $pickup, Address $destination, Customer $requester, Delivery\Priority $priority)
    {
        $this->pickup      = $pickup;
        $this->destination = $destination;
        $this->requester   = $requester;
        $this->priority    = $priority;
        $this->status      = Delivery\Status::RECEIVED();
    }

    /**
     * @return $this
     */
    public function pickup()
    {
        if ($this->status !== Delivery\Status::RECEIVED()) {
            throw new InvalidRequestException('Delivery status must be RECEIVED to mark as picked up.');
        }

        $this->status = Delivery\Status::PICKED_UP();

        return $this;
    }

    /**
     * @param string $signature
     * @return $this
     */
    public function deliver($signature)
    {
        if ($this->status !== Delivery\Status::PICKED_UP()) {
            throw new InvalidRequestException('Delivery status must be PICKED_UP to mark as delivered.');
        }

        $this->signature = $signature;
        $this->status    = Delivery\Status::DELIVERED();

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Address
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @return Address
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return Customer
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @return Delivery\Priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return Delivery\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}