<?php

namespace Materodev\ExtbaseUtilities\Utility;

use Materodev\ExtbaseUtilities\Helper\ArrayHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class TypoScriptUtility
{
    public function getPluginSettings(string $extensionName = null, string $pluginName = null): array
    {
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManager::class);
        $pluginTs = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, $extensionName, $pluginName);

        return $pluginTs;
    }

    public function getPluginSetting(string $settingName, string $extensionName = null, string $pluginName = null): mixed
    {
        $pluginTs = $this->getPluginSettings($extensionName, $pluginName);

        return ArrayHelper::getValue($pluginTs, $settingName);
    }
}
