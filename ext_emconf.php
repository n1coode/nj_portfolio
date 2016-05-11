<?php
/***************************************************************
 * Extension Manager/Repository config file for ext: "nj_portfolio"
***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'njs Portfolio Management',
    'description' => 'Showcase to present your art & work.',
    'category' => 'plugin',
    'author' => 'Nico Jatzkowski',
    'author_email' => 'nj@n1coo.de',
    'author_company' => 'n1coo.de',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'experimental',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => 
       'uploads/tx_njportfolio,
        uploads/tx_njportfolio/image,uploads/tx_njportfolio/image/work,uploads/tx_njportfolio/image/logo,uploads/tx_njportfolio/image/scancode,
        uploads/tx_njportfolio/audio,uploads/tx_njportfolio/video,
        uploads/tx_njportfolio/txt,uploads/tx_njportfolio/doc,
        uploads/tx_njportfolio/flipbook,uploads/tx_njportfolio/variant',
    'modify_tables' => '',
    'clearCacheOnLoad' => 1,
    'lockType' => '',
    'version' => '7.6.0',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => array(
        'depends' => array(
            'extbase' => '6.2.0-0.0.0',
            'fluid' => '6.2.0-0.0.0',
            'typo3' => '6.2.0-0.0.0',
			'nj_collection' => '7.6.0-0.0.0'
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
    '_md5_values_when_last_written' => '',
);