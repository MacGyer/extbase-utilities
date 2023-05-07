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
    protected ?ModuleTemplateFactory $moduleTemplateFactory;
    protected ?UriBuilder $backendUriBuilder;
    protected ?IconFactory $iconFactory;
    protected ModuleTemplate $moduleTemplate;

    public function injectModuleTemplateFactory(ModuleTemplateFactory $moduleTemplateFactory): void
    {
        $this->moduleTemplateFactory = $moduleTemplateFactory;
    }

    public function injectUriBuilder(UriBuilder $uriBuilder): void
    {
        $this->backendUriBuilder = $uriBuilder;
    }

    public function injectIconFactory(IconFactory $iconFactory): void
    {
        $this->iconFactory = $iconFactory;
    }

    protected function initializeAction()
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
