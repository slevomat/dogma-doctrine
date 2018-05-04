<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Time;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TimeType as DoctrineTimeType;
use Doctrine\DBAL\Types\Type;
use Dogma\Time\Time;

class TimeType extends DoctrineTimeType
{

    public const NAME = Type::TIME;

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Time\Time|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Time
    {
        if ($value === null || $value instanceof Time) {
            return $value;
        }

        return new Time($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
