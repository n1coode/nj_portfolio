<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjPortfolio\Service\Constants as Constants;
use N1coode\NjCollection\Utility\Constants as CConstants;

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';

$nj_collection_lang_file	= CConstants::NJ_EXT_LANG_FILE_BACKEND;
$nj_ext_key					= Constants::NJ_EXT_KEY;
$nj_ext_namespace			= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path				= Constants::NJ_EXT_PATH;
$nj_ext_sysfolder			= Constants::NJ_EXT_SYS_FOLDER;
$nj_ext_title				= Constants::NJ_EXT_TITLE;
$nj_ext_lang_file			= Constants::NJ_EXT_LANG_FILE_BACKEND;


/**
 * Register the plugin (to be listed in the Backend).
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Pi1',
    $nj_ext_lang_file.'plugin.title'
);


/**
 * TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', $nj_ext_title.' setup');


/**
 * Flexform
 */
// Clean up the Flexform fields in the backend a bit
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,splash_layout';
// Add own flexform stuff.
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_'.$nj_ext_key.'.xml');


