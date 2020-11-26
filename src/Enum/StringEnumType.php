<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Enum;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Dogma\Enum\StringEnum;
use Dogma\ShouldNotHappenException;

abstract class StringEnumType extends StringType
{

    abstract protected function getEnumClass(): string;

    public function getName(): string
    {
        throw new ShouldNotHappenException('Method getName() should be overwritten in child class!');
    }

    /**
     * @param StringEnum|string|null $value
     * @param AbstractPlatform $platform
     * @return StringEnum|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?StringEnum
    {
        if ($value === null || $value instanceof StringEnum) {
            return $value;
        }

        /** @var StringEnum $enumClass */
        $enumClass = $this->getEnumClass();

        return $enumClass::get($value);
    }

    /**
     * @param StringEnum|string|null $value
     * @param AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof StringEnum ? $value->getValue() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
