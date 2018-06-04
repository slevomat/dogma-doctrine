<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Email;

use Dogma\Doctrine\Enum\StringEnumType;
use Dogma\Email\EmailAddress;

class EmailHeaderType extends StringEnumType
{

    public const NAME = 'email_header';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getEnumClass(): string
    {
        return EmailAddress::class;
    }

}
