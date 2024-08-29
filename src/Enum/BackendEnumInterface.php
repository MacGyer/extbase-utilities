<?php

namespace Materodev\ExtbaseUtilities\Enum;

interface BackendEnumInterface extends \BackedEnum
{
    public function label(): string;
    public function equals(\BackedEnum $enum): bool;
    public static function allByKey(): array;
    public static function allByLabel(): array;
    public static function allLabelsByCase(): array;
    public static function getGridOptions(): array;
    public static function randomValue(): static;
}
