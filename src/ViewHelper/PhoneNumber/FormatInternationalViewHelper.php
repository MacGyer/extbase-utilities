<?php

declare(strict_types=1);

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\PhoneNumberFormat;

/** Formats a phone number in international format, e.g. +49 2151 9990 */
class FormatInternationalViewHelper extends AbstractPhoneViewHelper
{
    protected function getFormat(): int
    {
        return PhoneNumberFormat::INTERNATIONAL;
    }
}
