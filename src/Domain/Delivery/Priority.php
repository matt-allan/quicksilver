<?php

namespace Quicksilver\Domain\Delivery;

use MabeEnum\Enum;

/**
 * @method static Priority STANDARD()
 * @method static Priority RUSH()
 * @method static Priority DOUBLE_RUSH()
 */
class Priority extends Enum
{
    const STANDARD    = 'STANDARD';
    const RUSH        = 'RUSH';
    const DOUBLE_RUSH = 'DOUBLE_RUSH';
    const TRIPLE_RUSH = 'TRIPLE_RUSH';
}