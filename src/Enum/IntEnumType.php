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
     * @param \Dogma\Enum\IntEnum|int|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Enum\IntEnum|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntEnum
    {
        if ($value === null || $value instanceof IntEnum) {
            return $value;
        }

        /** @var \Dogma\Enum\IntEnum $enumClass */
        $enumClass = $this->getEnumClass();

        return $enumClass::get($value);
    }

    /**
     * @param \Dogma\Enum\IntEnum|int|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
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
