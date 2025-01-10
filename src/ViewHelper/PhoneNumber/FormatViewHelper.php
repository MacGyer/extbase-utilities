<?php

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FormatViewHelper extends AbstractViewHelper
{
    private PhoneNumberUtil $phoneNumberUtil;

    public function initializeArguments()
    {
        $this->registerArgument('number', 'string', 'The phone number', false, null);
        $this->registerArgument('countryCode', 'string', 'The number\'s country code', false, 'de');
        $this->registerArgument('format', 'int', 'The output format. For available options see libphonenumber\PhoneNumberFormat', false, PhoneNumberFormat::RFC3966);
    }

    public function render(): string
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();

        $format = $this->arguments['format'];

        try {
            $candidate = $this->arguments['number'] ?? $this->renderChildren();
            $number = $this->parseNumber($candidate);

            return $this->phoneNumberUtil->format($number, $format);
        } catch (\Exception $exception) {
            return $this->arguments['number'];
        }
    }

    private function parseNumber(string $number): ?PhoneNumber
    {
        $countryCode = strtoupper($this->arguments['countryCode']);
        $prototype = $this->phoneNumberUtil->parse($number, $countryCode);

        if (!$this->phoneNumberUtil->isValidNumber($prototype)) {
            throw new \InvalidArgumentException("Number '$number' is not a valid phone number");
        }

        return $prototype;
    }
}
