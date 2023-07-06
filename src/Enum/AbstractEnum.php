<?php

namespace Materodev\ExtbaseUtilities\Enum;

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

    public static function tcaItems(array $names = []): array
    {
        if (empty($names)) {
            $names = static::labels();
        }

        $data = [];
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
