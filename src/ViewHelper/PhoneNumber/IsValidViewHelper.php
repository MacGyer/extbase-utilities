<?php

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class IsValidViewHelper extends AbstractViewHelper
{
    private PhoneNumberUtil $phoneNumberUtil;

    public function initializeArguments()
    {
        $this->registerArgument('number', 'string', 'The phone number', false, null);
        $this->registerArgument('countryCode', 'string', 'The number\'s country code', false, 'de');
    }

    public function render()
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $countryCode = strtoupper($this->arguments['countryCode']);
            $candidate = $this->arguments['number'] ?? $this->renderChildren();
            $prototype = $phoneNumberUtil->parse($candidate, $countryCode);
            return $phoneNumberUtil->isValidNumber($prototype);
        } catch (\Exception $exception) {
            return false;
        }
    }
}
