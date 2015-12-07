<?php

namespace Quicksilver\Domain;

abstract class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}