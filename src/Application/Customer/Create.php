<?php

namespace Quicksilver\Application\Customer;

use Quicksilver\Domain\Customer;

class Create
{
    /**
     * @var Customer\Repository
     */
    private $customers;

    /**
     * @param Customer\Repository $customers
     */
    public function __construct(Customer\Repository $customers)
    {
        $this->customers = $customers;
    }

    /**
     * @return Customer
     */
    public function __invoke()
    {
        $customer = new Customer();

        $this->customers->save($customer);

        return $customer;
    }
}