<?php

namespace Materodev\ExtbaseUtilities\Provider;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

#[Autoconfigure(public: true)]
class GenericPageTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(string $title = ''): void
    {
        $this->title = $title;
    }
}
