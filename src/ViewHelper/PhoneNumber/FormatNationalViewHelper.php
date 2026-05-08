<?php

declare(strict_types=1);

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\PhoneNumberFormat;

/** Formats a phone number in national format, e.g. 02151 9990 */
class FormatNationalViewHelper extends AbstractPhoneViewHelper
{
    protected function getFormat(): int
    {
        return PhoneNumberFormat::NATIONAL;
    }
}
