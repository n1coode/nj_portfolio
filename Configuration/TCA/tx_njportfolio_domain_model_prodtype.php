<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjPortfolio\Service\Constants as Constants;
use N1coode\NjCollection\Utility\Constants as CConstants;

$nj_collection_lang_file	= CConstants::NJ_EXT_LANG_FILE_BACKEND;

$nj_ext_key					= Constants::NJ_EXT_KEY;
$nj_ext_namespace			= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path				= Constants::NJ_EXT_PATH;
$nj_ext_title				= Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= Constants::NJ_EXT_LANG_FILE_BACKEND;

$nj_domain_model = 'Prodtype';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
		'crdate' => 'crdate',
		'default_sortby' => 'ORDER BY title ASC',
		'delete' => 'deleted',
		'dividers2tabs' => TRUE,
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'title',
		'languageField' => 'sys_language_uid',
		'requestUpdate' => '',
		//'sortby' => 'sorting',
		'title' => $nj_ext_lang_file.'model.'.$nj_domain,
		'transOrigDiffSourceField' => 'l18n_diffsource',
        'transOrigPointerField' => 'l18n_parent',
        'tstamp' => 'tstamp',
	),
	'interface' => array(
		'showRecordFieldList' => 'title, description',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'title',
	),
	'columns' => array(
		'tstamp' => Array (
			'exclude' => 1,
			'label' => 'Creation date',
			'config' => Array (
				'type' => 'none',
				'format' => 'date',
				'eval' => 'date',
			)
		),
		'title' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.title',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,unique',
				'max'  => 256
			)
		),
		'description' => array(
			'exclude' => 1,
			'label'   => $nj_collection_lang_file.'label.general.description',
			'config'  => array(
				'type' => 'text',
				'eval' => 'trim',
				'cols' => 40,
				'rows' => 5
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'title, description'	)
	),
	'palettes' => array(
		'1' => array('showitem' => 'uid'),
	),
);