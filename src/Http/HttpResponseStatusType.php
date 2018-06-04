<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine;

use Dogma\Doctrine\Enum\IntEnumType;
use Dogma\Http\HttpResponseStatus;

class HttpResponseStatusType extends IntEnumType
{

    public const NAME = 'http_response_status';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getEnumClass(): string
    {
        return HttpResponseStatus::class;
    }

}
