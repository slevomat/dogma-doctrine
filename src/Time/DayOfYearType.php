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
use Doctrine\DBAL\Types\IntegerType;
use Dogma\Time\DayOfYear;

class DayOfYearType extends IntegerType
{

    public const NAME = 'day_of_year';

    public function getName(): string
    {
        return self::NAME;
    }

	/**
	 * @param \Dogma\Time\DayOfYear|int|null $value
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
	 * @return \Dogma\Time\DayOfYear|null
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?DayOfYear
	{
		if ($value === null || $value instanceof DayOfYear) {
			return $value;
		}

		return new DayOfYear((int) $value);
	}

	/**
	 * @param \Dogma\Time\DayOfYear|int|null $value
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
	 * @return int|null
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
	{
		return $value instanceof DayOfYear ? $value->getNumber() : $value;
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}

}
