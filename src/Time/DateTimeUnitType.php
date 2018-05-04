<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Time;

use Dogma\Doctrine\Enum\StringEnumType;
use Dogma\Time\DateTimeUnit;

class DateTimeUnitType extends StringEnumType
{

    public const NAME = 'date_time_unit_type';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getEnumClass(): string
    {
        return DateTimeUnit::class;
    }

}
