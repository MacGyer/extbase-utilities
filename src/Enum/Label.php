<?php

namespace Materodev\ExtbaseUtilities\Enum;

#[\Attribute]
class Label
{
    public string $label;

    public function __construct(string $label)
    {
        $this->label = $label;
    }
}
