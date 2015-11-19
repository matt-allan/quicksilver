<?php

namespace Quicksilver\Domain;

abstract class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * Customer constructor.
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}