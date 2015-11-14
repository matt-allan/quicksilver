<?php

namespace Quicksilver\Application\Auth;

use Quicksilver\Domain\User;

interface Guard
{
    /**
     * Gets the current logged in user.
     *
     * @return User
     */
    public function user();
}