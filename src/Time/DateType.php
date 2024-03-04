<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Time;

use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\InvalidType;
use Doctrine\DBAL\Types\Type;
use Dogma\Time\Date;

class DateType extends Type
{

	public const NAME = 'date';

	public function getName(): string
	{
		return self::NAME;
	}

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return $value;
        } elseif ($value instanceof Date) {
            return $value->format($platform->getDateFormatString());
        } elseif ($value instanceof DateTimeInterface) {
            return $value->format($platform->getDateFormatString());
        }

        throw InvalidType::new($value, $this->getName(), ['null', 'DateTimeInterface', 'Dogma\\Time\\Date']);
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Date|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Date
    {
        if ($value === null || $value instanceof Date) {
            return $value;
        }

        return new Date($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

	public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
	{
		return $platform->getDateTypeDeclarationSQL($column);
	}
}
