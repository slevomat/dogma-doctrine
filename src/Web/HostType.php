<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Web;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Dogma\Web\Host;
use PHPStan\Type\StringType;

class HostType extends StringType
{

    public const NAME = 'host_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Dogma\Web\Host|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Web\Host|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Host
    {
        if ($value === null || $value instanceof Host) {
            return $value;
        }

        return new Host($value);
    }

    /**
     * @param \Dogma\Web\Host|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Host ? $value->format() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
