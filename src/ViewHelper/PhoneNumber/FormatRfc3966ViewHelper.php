<?php

declare(strict_types=1);

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\PhoneNumberFormat;

/** Formats a phone number as RFC 3966 URI, e.g. tel:+49-2151-9990 — use for href="tel:" links */
class FormatRfc3966ViewHelper extends AbstractPhoneViewHelper
{
    protected function getFormat(): int
    {
        return PhoneNumberFormat::RFC3966;
    }
}
