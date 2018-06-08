<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Time;

use Dogma\Doctrine\Enum\IntEnumType;
use Dogma\Time\DayOfWeek;

class DayOfWeekType extends IntEnumType
{

    public const NAME = 'day_of_week';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getEnumClass(): string
    {
        return DayOfWeek::class;
    }

}
