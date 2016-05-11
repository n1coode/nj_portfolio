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

$nj_domain_model = 'Portfolio';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
		'crdate' => 'crdate',
		'default_sortby' => 'ORDER BY title ASC',
		'delete' => 'deleted',
		'dividers2tabs' => TRUE,
		'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'title',
		'languageField' => 'sys_language_uid',
		'origUid' => 't3_origuid',
		'requestUpdate' => 'sys_language_uid',
		//'sortby' => 'sorting',
		'title' => $nj_ext_lang_file.'model.'.$nj_domain,
		'transOrigDiffSourceField' => 'l18n_diffsource',
        'transOrigPointerField' => 'l18n_parent',
        'tstamp' => 'tstamp',
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
	),
	'interface' => array(
        'showRecordFieldList' => 'sorting',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'always_description' => 1,
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
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'description' => array(
			'exclude' => 1,
			'label'   => $nj_collection_lang_file.'label.general.description',
			'defaultExtras' => 'richtext[*]',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]'
			)
		),
		'work' => Array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.work',
			'config' => Array(
				'type' => 'inline',
				'foreign_table' => $nj_ext_key.'_domain_model_work',
				'foreign_sortby' => 'sorting',
				'maxitems' => 15,
				'appearance' => Array(
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			),
		),
	),
	'types' => array(
		'0' => array('showitem' =>
			'--div--;'.$nj_collection_lang_file.'tab.general.generalSettings,
			title, description,
			--div--;'.$nj_ext_lang_file.'tab.model.'.$nj_domain.'.works,
			work'
		)
	),
	'palettes' => array(
		'1' => array('showitem' => 'uid'),
	),
);