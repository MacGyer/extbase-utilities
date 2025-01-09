<?php

namespace Materodev\ExtbaseUtilities\Utility;

use TYPO3\CMS\Backend\Form\FormDataProvider\TcaSlug;

class TcaUtility
{
    public function getEmptySlugPrefix(array $params, TcaSlug $reference): string
    {
        return '';
    }
}
