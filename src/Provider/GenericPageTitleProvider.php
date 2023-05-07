<?php

namespace Materodev\ExtbaseUtilities\Provider;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class GenericPageTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(string $title = ''): void
    {
        $this->title = $title;
    }
}