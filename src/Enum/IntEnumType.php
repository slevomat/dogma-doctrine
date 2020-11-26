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
use Doctrine\DBAL\Types\IntegerType;
use Dogma\Enum\IntEnum;
use Dogma\ShouldNotHappenException;

abstract class IntEnumType extends IntegerType
{

    abstract protected function getEnumClass(): string;

    public function getName(): string
    {
        throw new ShouldNotHappenException('Method getName() should be overwritten in child class!');
    }

    /**
     * @param IntEnum|int|null $value
     * @param AbstractPlatform $platform
     * @return IntEnum|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntEnum
    {
        if ($value === null || $value instanceof IntEnum) {
            return $value;
        }

        /** @var IntEnum $enumClass */
        $enumClass = $this->getEnumClass();

        return $enumClass::get((int) $value);
    }

    /**
     * @param IntEnum|int|null $value
     * @param AbstractPlatform $platform
     * @return int|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value instanceof IntEnum ? $value->getValue() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
