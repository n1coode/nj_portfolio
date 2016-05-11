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

$nj_domain_model = 'Client';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
		'crdate' => 'crdate',
		'default_sortby' => 'ORDER BY name ASC',
		'delete' => 'deleted',
		'dividers2tabs' => TRUE,
		'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'name',
		'languageField' => 'sys_language_uid',
		'requestUpdate' => 'sys_language_uid',
		//'sortby' => 'sorting',
		'title' => $nj_ext_lang_file.'model.'.$nj_domain,
		'transOrigDiffSourceField' => 'l18n_diffsource',
        'transOrigPointerField' => 'l18n_parent',
        'tstamp' => 'tstamp',
	),
	'interface' => array(
		'showRecordFieldList' => 'name, street, street_nr, city, zip_code, country, email, website, logo, scan_code',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'name',
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
		'cd_color_back' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.cdColorBack',
			'config'  => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'cd_color_front' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.cdColorFront',
			'config'  => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'city' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.city',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'country' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.country',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'email' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.email',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'logo' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.imageFile',
			'config' => array(
				'maxitems' => 1,
				'uploadfolder' => 'uploads/tx_njportfolio/image/logo',
				'type' => 'inline',
				'foreign_table' => 'sys_file_reference',
				'foreign_field' => 'uid_foreign',
				'foreign_sortby' => 'sorting_foreign',
				'foreign_table_field' => 'tablenames',
				'foreign_match_fields' => array(
					'fieldname' => 'logo'
				),
				'foreign_label' => 'uid_local',
				'foreign_selector' => 'uid_local',
				'foreign_selector_fieldTcaOverride' => array(
					'config' => array(
						'appearance' => array(
							'elementBrowserType' => 'file',
							'elementBrowserAllowed' => 'jpg,png,gif'
						)
					)
				),
				'filter' => array(
					array(
						'userFunc' => 'TYPO3\\CMS\\Core\\Resource\\Filter\\FileExtensionFilter->filterInlineChildren',
						'parameters' => array(
							'allowedFileExtensions' => 'jpg,png,gif',
							'disallowedFileExtensions' => ''
						)
					)
				),
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference',
					'useSortable' => TRUE,
					'collapseAll' => 1,
					'expandSingle' => 1,
					'headerThumbnail' => array(
						'field' => 'uid_local',
						'width' => '150',
						'height' => '150',
					),
					'showPossibleLocalizationRecords' => TRUE,
					'showRemovedLocalizationRecords' => TRUE,
					'showSynchronizationLink' => TRUE,
					'enabledControls' => array(
						'info' => TRUE,
						'new' => TRUE,
						'dragdrop' => TRUE,
						'sort' => TRUE,
						'hide' => TRUE,
						'delete' => TRUE,
						'localize' => TRUE,
					),
				),
				'behaviour' => array(
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => TRUE,
				),
			),
		),
		'name' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.name',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required',
				'max'  => 256
			)
		),
		'scan_code' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.imageFile',
			'config' => array(
				'maxitems' => 1,
				'uploadfolder' => 'uploads/tx_njportfolio/image/scancode',
				'type' => 'inline',
				'foreign_table' => 'sys_file_reference',
				'foreign_field' => 'uid_foreign',
				'foreign_sortby' => 'sorting_foreign',
				'foreign_table_field' => 'tablenames',
				'foreign_match_fields' => array(
					'fieldname' => 'scan_code'
				),
				'foreign_label' => 'uid_local',
				'foreign_selector' => 'uid_local',
				'foreign_selector_fieldTcaOverride' => array(
					'config' => array(
						'appearance' => array(
							'elementBrowserType' => 'file',
							'elementBrowserAllowed' => 'jpg,png,gif'
						)
					)
				),
				'filter' => array(
					array(
						'userFunc' => 'TYPO3\\CMS\\Core\\Resource\\Filter\\FileExtensionFilter->filterInlineChildren',
						'parameters' => array(
							'allowedFileExtensions' => 'jpg,png,gif',
							'disallowedFileExtensions' => ''
						)
					)
				),
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference',
					'useSortable' => TRUE,
					'collapseAll' => 1,
					'expandSingle' => 1,
					'headerThumbnail' => array(
						'field' => 'uid_local',
						'width' => '150',
						'height' => '150',
					),
					'showPossibleLocalizationRecords' => TRUE,
					'showRemovedLocalizationRecords' => TRUE,
					'showSynchronizationLink' => TRUE,
					'enabledControls' => array(
						'info' => TRUE,
						'new' => TRUE,
						'dragdrop' => TRUE,
						'sort' => TRUE,
						'hide' => TRUE,
						'delete' => TRUE,
						'localize' => TRUE,
					),
				),
				'behaviour' => array(
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => TRUE,
				),
			),
		),
		'street' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.street',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256 
			)
		),
		'trades' => Array (
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.trade',
            'config' => Array (
                'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => $nj_ext_key.'_domain_model_trade',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_trade.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_trade.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_trade.title',
                'minitems' => 1,
                'maxitems' => 10,
            ),
        ),
		'website' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.website',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			)
		),
		'zip_code' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.zipCode',
			'config'  => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim',
				'max'  => 256
			)
		),
	),
	'types' => array(
		'0' => array('showitem' =>
			'--div--;'.$nj_collection_lang_file.'tab.general.generalSettings,
			name, trades, street, city, zip_code, country, 
			--div--;'.$nj_collection_lang_file.'tab.general.additionalInformation,
			email, website,
			--div--;'.$nj_ext_lang_file.'tab.model.client.logo,
			logo,cd_color_front,cd_color_back,
			--div--;'.$nj_ext_lang_file.'tab.model.client.scanCode,
			scan_code'
		)
	),
	'palettes' => array(
		'1' => array('showitem' => 'uid'),
	),
);