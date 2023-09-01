<?php

namespace Materodev\ExtbaseUtilities\Enum;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

abstract class AbstractEnum
{
    public static function labels(): array
    {
        return [];
    }

    public static function label(mixed $key, $fallback = null): mixed
    {
        if ($key === null) {
            return $fallback;
        }

        $labels = static::labels();
        if (isset($labels[$key])) {
            $value = $labels[$key];
            if (str_starts_with($value, 'LLL:')) {
                return LocalizationUtility::translate($value);
            }
            return $labels[$key];
        }

        return $fallback;
    }

    public static function data(array $names = []): array
    {
        if (empty($names)) {
            $names = static::labels();
        }
        $data = [];
        foreach ($names as $id => $name) {
            $data[] = [
                'name' => $name,
                'id' => $id
            ];
        }
        return $data;
    }

    public static function tcaItems(array $names = [], bool $includeBlank = true, mixed $blankValue = 0, mixed $blankLabel = ''): array
    {
        if (empty($names)) {
            $names = static::labels();
        }

        $data = [];

        if ($includeBlank) {
            $data[] = [
                'label' => $blankLabel,
                'value' => $blankValue
            ];
        }

        foreach ($names as $id => $name) {
            $data[] = [
                'label' => $name,
                'value' => $id,
            ];
        }

        return $data;
    }

    public static function exists(mixed $id): bool
    {
        $names = static::labels();
        return isset($names[$id]);
    }

    public static function ids(): array
    {
        return array_keys(static::labels());
    }
}
