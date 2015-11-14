<?php

namespace Quicksilver\Domain\Delivery;

use MabeEnum\Enum;

/**
 * @method static Status RECEIVED()
 * @method static Status PICKED_UP()
 * @method static Status DELIVERED()
 */
class Status extends Enum
{
    const RECEIVED  = 'RECEIVED';
    const PICKED_UP = 'PICKED_UP';
    CONST DELIVERED = 'DELIVERED';
}