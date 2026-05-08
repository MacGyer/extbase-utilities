<?php

declare(strict_types=1);

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\PhoneNumberFormat;

class FormatViewHelper extends AbstractPhoneViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('format', 'string', 'Output format: NATIONAL, INTERNATIONAL, E164, RFC3966', false, 'NATIONAL');
    }

    protected function getFormat(): int
    {
        return match (strtoupper((string)$this->arguments['format'])) {
            'NATIONAL' => PhoneNumberFormat::NATIONAL,
            'E164' => PhoneNumberFormat::E164,
            'RFC3966' => PhoneNumberFormat::RFC3966,
            default => PhoneNumberFormat::INTERNATIONAL,
        };
    }
}
