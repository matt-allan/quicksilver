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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}