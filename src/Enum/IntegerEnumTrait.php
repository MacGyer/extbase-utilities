<?php

namespace Materodev\ExtbaseUtilities\Enum;

use Materodev\ExtbaseUtilities\Enum\Label;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

trait IntegerEnumTrait
{
    public function label(): string
    {
        $refEnum = new \ReflectionEnum($this::class);
        $case = $refEnum->getCase($this->name);
        /** @var \ReflectionAttribute<Label>[] $attributes */
        $attributes = $case->getAttributes(Label::class);

        if (empty($attributes)) {
            throw new \RuntimeException("Attribute for enum case {$this->name} not defined. Use #Label('...')");
        }

        $attribute = reset($attributes);
        /** @var Label $instance */
        $instance = $attribute->newInstance();

        return $instance->label;
    }

    public function localizedLabel(): string
    {
        $label = $this->label();
        if (str_starts_with($label, 'LLL:')) {
            return LocalizationUtility::translate($label);
        }

        return $label;
    }

    /**
     * Wrap label() for use in magic getters like Fluid
     */
    public function getLabel(): string
    {
        return $this->label();
    }

    /**
     * Wrap localizedLabel() for use in magic getters like Fluid
     */
    public function getLocalizedLabel(): string
    {
        return $this->localizedLabel();
    }

    public function getShortName(): string
    {
        $result = '';
        $parts = preg_split('/[ _-]+/', $this->label());

        foreach ($parts as $part) {
            $result .= mb_substr($part, 0, 1);
        }

        return $result;
    }

    public function equals(\BackedEnum $enum): bool
    {
        return $this === $enum;
    }

    /**
     * @return array<int, string>
     */
    public static function allByKey(): array
    {
        $labels = [];

        /** @var IntegerEnumTrait $case */
        foreach (static::cases() as $case) {
            $labels[$case->value] = $case->label();
        }

        return $labels;
    }

    /**
     * @return array<int, string>
     */
    public static function tcaItems(bool $includeBlank = true, mixed $blankValue = 0, mixed $blankLabel = ''): array
    {
        $labels = [];

        if ($includeBlank) {
            $labels[] = [
                'value' => $blankValue,
                'label' => $blankLabel,
            ];
        }

        /** @var IntegerEnumTrait $case */
        foreach (static::cases() as $case) {
            $labels[] = [
                'value' => $case->value,
                'label' => $case->label(),
            ];
        }

        return $labels;
    }

    /**
     * @return array<string, int>
     */
    public static function allByLabel(): array
    {
        $labels = [];

        /** @var IntegerEnumTrait $case */
        foreach (static::cases() as $case) {
            $labels[$case->label()] = $case->value;
        }

        return $labels;
    }

    public static function allLabelsByCase(): array
    {
        $labels = [];

        /** @var IntegerEnumTrait $case */
        foreach (static::cases() as $case) {
            $labels[$case->name] = $case->label();
        }

        return $labels;
    }

    public static function getGridOptions(): array
    {
        $options = [];

        /** @var IntegerEnumTrait $case */
        foreach (static::cases() as $case) {
            $options[] = [
                'label' => $case->label(),
                'value' => $case->value,
            ];
        }

        return $options;
    }

    public static function randomValue(): static
    {
        $cases = static::cases();

        return $cases[array_rand($cases)];
    }

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if ($name === $case->name) {
                return $case;
            }
        }

        throw new \ValueError("$name is not a valid backing value for enum " . self::class);
    }

    public static function fromLabel(string $label): self
    {
        foreach (self::cases() as $case) {
            $caseLabel = $case->localizedLabel();
            if ($label === $case->localizedLabel()) {
                return $case;
            }
        }

        throw new \ValueError("Enum could not be determined by label '$label' in " . self::class);
    }
}
