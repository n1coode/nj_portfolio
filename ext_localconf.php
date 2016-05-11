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


$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY] = unserialize($_EXTCONF);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'N1coode.'.$_EXTKEY,
    'Pi1',
    array(
		'Ajax' => 'workDigest,workImage,workRandom',
		'Category' => 'list,menu',
		'Header' => 'index',
        'Portfolio' => 'index,list',
        'Work' => 'index,digest,focus,focusClient,highlights,list,selection',
    ),
    // non-cacheable actions
    array( 
        'Ajax' => 'workDigest,workImage,workRandom',
		'Category' => 'list,menu',
		'Header' => 'index',
        'Portfolio' => 'index,list',
        'Work' => 'index,digest,focus,focusClient,highlights,list,selection',
    )
);

$pageLayout = 'EXT:'.$nj_ext_path.'/Classes/Hooks/PageLayoutView.php:N1coode\\'.$nj_ext_namespace.'\Hooks\PageLayoutView';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem'][$_EXTKEY] = $pageLayout;