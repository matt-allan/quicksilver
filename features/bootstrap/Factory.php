<?php

use Quicksilver\Domain\Address;
use Quicksilver\Domain\Courier;
use Quicksilver\Domain\Customer;
use Quicksilver\Domain\Delivery;
use Quicksilver\Domain\Delivery\Priority;

class Factory
{
    /**
     * @var \Faker\Generator
     */
    protected static $faker;

    /**
     * @return Address
     */
    public static function address()
    {
        return new Address(
            self::faker()->name,
            self::faker()->streetAddress,
            self::faker()->city,
            self::faker()->stateAbbr,
            self::faker()->postCode
        );
    }

    public static function courier()
    {
        return new Courier();
    }

    /**
     * @return Customer
     */
    public static function customer()
    {
        return new Customer();
    }

    public static function delivery(Address $pickup = null, Address $destination = null, Customer $customer = null, Priority $priority = null)
    {
        return new Delivery(
            $pickup ?: self::address(),
            $destination ?: self::address(),
            $customer ?: self::customer(),
            $priority ?: Priority::STANDARD()
        );
    }

    /**
     * @return \Faker\Generator
     */
    protected static function faker()
    {
        if (self::$faker) {
            return self::$faker;
        }

        return self::$faker = \Faker\Factory::create();
    }
}