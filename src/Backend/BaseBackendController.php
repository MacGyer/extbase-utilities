<?php

namespace Materodev\ExtbaseUtilities\Backend;

use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;

abstract class BaseBackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected ?UriBuilder $backendUriBuilder;
    protected ModuleTemplate $moduleTemplate;

    public function __construct(
        private readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly IconFactory $iconFactory
    ) {
    }

    public function injectUriBuilder(UriBuilder $uriBuilder): void
    {
        $this->backendUriBuilder = $uriBuilder;
    }

    protected function initializeAction(): void
    {
        parent::initializeAction();
        $this->moduleTemplate = $this->moduleTemplateFactory->create($this->request);
    }

    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
