<?php

namespace Quicksilver\Application\Delivery;

class CreateRequest
{
    /**
     * @var string
     */
    private $pickupName;

    /**
     * @var string
     */
    private $pickupStreet;

    /**
     * @var string
     */
    private $pickupCity;

    /**
     * @var string
     */
    private $pickupState;

    /**
     * @var string
     */
    private $pickupPostCode;

    /**
     * @var string
     */
    private $dropoffName;

    /**
     * @var string
     */
    private $dropoffStreet;

    /**
     * @var string
     */
    private $dropoffCity;

    /**
     * @var string
     */
    private $dropoffState;

    /**
     * @var string
     */
    private $dropoffPostCode;

    /**
     * @var string
     */
    private $priority;

    /**
     * CreateRequest constructor.
     * @param string $pickupName
     * @param string $pickupStreet
     * @param string $pickupCity
     * @param string $pickupState
     * @param string $pickupPostCode
     * @param string $dropoffName
     * @param string $dropoffStreet
     * @param string $dropoffCity
     * @param string $dropoffState
     * @param string $dropoffPostCode
     * @param string $priority
     */
    public function __construct($pickupName, $pickupStreet, $pickupCity, $pickupState, $pickupPostCode, $dropoffName, $dropoffStreet, $dropoffCity, $dropoffState, $dropoffPostCode, $priority)
    {
        $this->pickupName      = $pickupName;
        $this->pickupStreet    = $pickupStreet;
        $this->pickupCity      = $pickupCity;
        $this->pickupState     = $pickupState;
        $this->pickupPostCode  = $pickupPostCode;
        $this->dropoffName     = $dropoffName;
        $this->dropoffStreet   = $dropoffStreet;
        $this->dropoffCity     = $dropoffCity;
        $this->dropoffState    = $dropoffState;
        $this->dropoffPostCode = $dropoffPostCode;
        $this->priority        = $priority;
    }

    /**
     * @return string
     */
    public function getPickupName()
    {
        return $this->pickupName;
    }

    /**
     * @return string
     */
    public function getPickupStreet()
    {
        return $this->pickupStreet;
    }

    /**
     * @return string
     */
    public function getPickupCity()
    {
        return $this->pickupCity;
    }

    /**
     * @return string
     */
    public function getPickupState()
    {
        return $this->pickupState;
    }

    /**
     * @return string
     */
    public function getPickupPostCode()
    {
        return $this->pickupPostCode;
    }

    /**
     * @return string
     */
    public function getDropoffName()
    {
        return $this->dropoffName;
    }

    /**
     * @return string
     */
    public function getDropoffStreet()
    {
        return $this->dropoffStreet;
    }

    /**
     * @return string
     */
    public function getDropoffCity()
    {
        return $this->dropoffCity;
    }

    /**
     * @return string
     */
    public function getDropoffState()
    {
        return $this->dropoffState;
    }

    /**
     * @return string
     */
    public function getDropoffPostCode()
    {
        return $this->dropoffPostCode;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }
}