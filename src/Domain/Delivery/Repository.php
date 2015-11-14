<?php

namespace Quicksilver\Domain\Delivery;

use Quicksilver\Domain\Delivery;

interface Repository
{
    /**
     * @param $id
     * @return Delivery|null
     */
    public function find($id);

    /**
     * @return Delivery[]
     */
    public function findAll();

    /**
     * @param Delivery $delivery
     */
    public function save(Delivery $delivery);
}