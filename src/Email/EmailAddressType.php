<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Email;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Dogma\Email\EmailAddress;
use PHPStan\Type\StringType;

class EmailAddressType extends StringType
{

    public const NAME = 'email_address';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Dogma\Email\EmailAddress|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Email\EmailAddress|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?EmailAddress
    {
        if ($value === null || $value instanceof EmailAddress) {
            return $value;
        }

        return new EmailAddress($value);
    }

    /**
     * @param \Dogma\Email\EmailAddress|string|null $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof EmailAddress ? $value->getValue() : $value;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}
