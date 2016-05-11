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

$nj_domain_model = 'Work';
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
		'requestUpdate' => 'show_conclusion,show_description,show_intro',
		//'sortby' => 'sorting',
		'title' => $nj_ext_lang_file.'model.'.$nj_domain,
		'transOrigDiffSourceField' => 'l18n_diffsource',
        'transOrigPointerField' => 'l18n_parent',
        'tstamp' => 'tstamp',
		'versioning_followPages' => TRUE,
		'versioningWS' => 2,
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
		'categories' => array(
			'exclude'	=> 0,
			'label'		=> $nj_ext_lang_file.'model.category',
			'config'	=> array(
				'type' 					=> 'select',
				'renderType'			=> 'selectMultipleSideBySide',
				'foreign_table' 		=> 'tx_njportfolio_domain_model_category',
				'foreign_table_where' 	=> 'ORDER BY tx_njportfolio_domain_model_category.title',
				'size'					=> 10,
				'maxitems' 				=> 10,
			)
		),
		'client' => array (
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'model.client',
            'config' => array (
                'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => $nj_ext_key.'_domain_model_client',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_client.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_client.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_client.name',
                'size' => 10,
				'minitems' => 1,
                'maxitems' => 1,
				'wizards' => array(
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'edit',
						'module' => array(
							'name' => 'wizard_edit',
						),
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
					),
					'add' => array(
						'type' => 'script',
						'title' => 'add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_njportfolio_domain_model_client',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'module' => array(
							'name' => 'wizard_add'
						)
					),
					'list' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:lang/locallang_tca.xlf:be_users.usergroup_list_title',
						'icon' => 'list.gif',
						'params' => array(
							'table' => 'tx_njportfolio_domain_model_client',
							'pid' => '###CURRENT_PID###'
						),
						'module' => array(
							'name' => 'wizard_list'
						)
					)
				)
            ),
        ),
		'conclusion' => array(
			'displayCond' => 'FIELD:show_conclusion:=:1',
			'exclude' => 1,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.conclusion',
			'defaultExtras' => 'richtext[*]',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]'
			)
		),
		'date' => Array (
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.work.creationYear',			
			'config'  => Array (
				'type' => 'input',
				'size' => 10,
				'format' => 'date',
				'eval' => 'date,year,trim',
			)
		),
		'description' => array(
			'displayCond' => 'FIELD:show_description:=:1',
			'exclude' => 1,
			'label'   => $nj_ext_lang_file.'label.general.description',
			'defaultExtras' => 'richtext[*]',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]'

			)
		),
		'highlight' => array(
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.model.work.highlight',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'images' => array(
			'exclude' => 0,
			'label' => $nj_collection_lang_file.'label.general.imageFile',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
		'intro' => array(
			'displayCond' => 'FIELD:show_intro:=:1',
			'exclude' => 1,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.intro',
			'defaultExtras' => 'richtext[*]',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]'
			)
		),
		'products' => Array ( 
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'model.product',
			'config' => Array (
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_njportfolio_domain_model_product',
				'foreign_table_where' => 'AND tx_njportfolio_domain_model_product.pid=###CURRENT_PID### ORDER BY tx_njportfolio_domain_model_product.title',
				'minitems' => 1,
				'maxitems' => 99,
				'size' => '10',
				'wizards' => array(
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'edit',
						'module' => array(
							'name' => 'wizard_edit',
						),
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
					),
					'add' => array(
						'type' => 'script',
						'title' => 'add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_njportfolio_domain_model_product',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'module' => array(
							'name' => 'wizard_add'
						)
					),
					'list' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:lang/locallang_tca.xlf:be_users.usergroup_list_title',
						'icon' => 'list.gif',
						'params' => array(
							'table' => 'tx_njportfolio_domain_model_product',
							'pid' => '###CURRENT_PID###'
						),
						'module' => array(
							'name' => 'wizard_list'
						)
					)
				)
			)
		),
		'show_conclusion' => array(
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.model.work.showConclusion',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'show_description' => array(
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.general.showDescription',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'show_intro' => array(
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.model.work.showIntro',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'title' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.title',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
	),
	'types' => array(
		'0' => array('showitem' =>
			'--div--;'.$nj_collection_lang_file.'tab.general.generalSettings,
			title, date, highlight,client,
			--div--;'.$nj_collection_lang_file.'tab.general.categorization,
			categories, products, 
			--div--;'.$nj_collection_lang_file.'tab.general.description,
			show_intro,intro,show_description,description,show_conclusion,conclusion,
			--div--;'.$nj_collection_lang_file.'tab.general.images,
			images'
		)
	),
	'palettes' => array(
		'1' => array('showitem' => 'uid'),
	),
);