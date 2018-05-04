<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Language\Locale;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Dogma\Language\Locale\Locale;

class LocaleType extends StringType
{

    public const NAME = 'locale_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Dogma\Language\Locale\Locale|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Language\Locale\Locale|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Locale
    {
        if ($value === null || $value instanceof Locale) {
            return $value;
        }

        return Locale::get($value);
    }

    /**
     * @param \Dogma\Enum\StringEnum|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Locale ? $value->getValue() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
