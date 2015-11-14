<?php

namespace Quicksilver\Domain\Customer;

use Quicksilver\Domain\Customer;

interface Repository
{
    /**
     * @param $id
     * @return Customer|null
     */
    public function find($id);

    /**
     * @return Customer[]
     */
    public function findAll();

    /**
     * @param Customer $customer
     */
    public function save(Customer $customer);
}