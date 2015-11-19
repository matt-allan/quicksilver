<?php

namespace Quicksilver\Domain;

class Address
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $postCode;

    /**
     * Address constructor.
     * @param string $name
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $postCode
     */
    public function __construct($name, $street, $city, $state, $postCode)
    {
        $this->name     = $name;
        $this->street   = $street;
        $this->city     = $city;
        $this->state    = $state;
        $this->postCode = $postCode;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }
}