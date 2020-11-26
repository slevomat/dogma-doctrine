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
use Doctrine\DBAL\Types\StringType;
use Dogma\Web\Domain;

class DomainType extends StringType
{

    public const NAME = 'domain';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param Domain|string|null $value
     * @param AbstractPlatform $platform
     * @return Domain|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Domain
    {
        if ($value === null || $value instanceof Domain) {
            return $value;
        }

        return new Domain($value);
    }

    /**
     * @param Domain|string|null $value
     * @param AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Domain ? $value->getName() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
