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
use Doctrine\DBAL\Types\DateTimeType as DoctrineDateTimeType;
use Doctrine\DBAL\Types\Type;
use Dogma\Time\DateTime;

class DateTimeType extends DoctrineDateTimeType
{

    public const NAME = Type::DATETIME;

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Time\DateTime|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?DateTime
    {
        if ($value === null || $value instanceof DateTime) {
            return $value;
        }

        return new DateTime($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
