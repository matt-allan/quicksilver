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
}