<?php

declare(strict_types=1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class PaymentType extends AbstractEnumType
{
    public const TYPE_CB = 'type-cb';
    public const TYPE_CASH = 'type-cash';

    protected static array $choices = [
        self::TYPE_CB => self::TYPE_CB,
        self::TYPE_CASH => self::TYPE_CASH
    ];
}
