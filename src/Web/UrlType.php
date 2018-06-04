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
use Dogma\Web\Url;

class UrlType extends StringType
{

    public const NAME = 'url';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Dogma\Web\Url|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Web\Url|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Url
    {
        if ($value === null || $value instanceof Url) {
            return $value;
        }

        return new Url($value);
    }

    /**
     * @param \Dogma\Web\Url|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Url ? $value->getValue() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
