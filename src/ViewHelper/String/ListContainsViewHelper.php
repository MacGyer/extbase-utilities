<?php

namespace Materodev\ExtbaseUtilities\ViewHelper\String;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

class ListContainsViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('candidate', 'string', 'The candidate to find in list', true);
        $this->registerArgument('separator', 'string', 'The list item separator', false, ',');
        $this->registerArgument('list', 'string', 'The list to find the candidate in', true);
        $this->registerArgument('negate', 'boolean', 'Whether to negate the verdict', false, false);
    }

    public static function verdict(array $arguments, RenderingContextInterface $renderingContext): bool
    {
        $list = GeneralUtility::trimExplode($arguments['separator'], $arguments['list'], true);
        $candidate = trim($arguments['candidate']);

        if ($arguments['negate']) {
            return !in_array($candidate, $list, true);
        }
        return in_array($candidate, $list, true);
    }
}
