<?php

declare(strict_types=1);

namespace Materodev\ExtbaseUtilities\ViewHelper\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use TYPO3\CMS\Core\Country\Country;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

abstract class AbstractPhoneViewHelper extends AbstractViewHelper
{
    abstract protected function getFormat(): int;

    public function initializeArguments(): void
    {
        $this->registerArgument('number', 'string', 'Phone number in E.164 or international format', false);
        $this->registerArgument('defaultRegion', 'mixed', 'Default region hint: ISO 3166-1 alpha-2 string or Country object', false, 'DE');
    }

    public function render(): string
    {
        $number = $this->arguments['number'] ?? $this->renderChildren();

        if (empty($number)) {
            return '';
        }

        try {
            $util = PhoneNumberUtil::getInstance();
            $parsed = $util->parse($number, static::resolveRegion($this->arguments['defaultRegion']));
            return $util->format($parsed, $this->getFormat());
        } catch (NumberParseException) {
            return $number;
        }
    }

    protected static function resolveRegion(mixed $region): string
    {
        if ($region instanceof Country) {
            return $region->getAlpha2IsoCode();
        }
        return strtoupper((string)$region);
    }
}
