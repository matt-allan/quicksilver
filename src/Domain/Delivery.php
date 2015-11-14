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
        $this->signature = $signature;
        $this->status    = Delivery\Status::DELIVERED();

        return $this;
    }

    /**
     * @return Delivery\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}