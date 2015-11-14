<?php

namespace Quicksilver\Domain\Courier;

use Quicksilver\Domain\Courier;

interface Repository
{
    /**
     * @param $id
     * @return Courier|null
     */
    public function find($id);

    /**
     * @return Courier[]
     */
    public function findAll();

    /**
     * @param Courier $courier
     */
    public function save(Courier $courier);
}