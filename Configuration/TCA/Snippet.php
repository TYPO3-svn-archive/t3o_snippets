<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_t3osnippets_domain_model_snippet'] = array(
	'ctrl' => $TCA['tx_t3osnippets_domain_model_snippet']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, category, description, author, code, tags',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, category, description, author, code, tags,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_t3osnippets_domain_model_snippet',
				'foreign_table_where' => 'AND tx_t3osnippets_domain_model_snippet.pid=###CURRENT_PID### AND tx_t3osnippets_domain_model_snippet.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'tstamp' => Array (
			'exclude' => 1,
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.category',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_t3osnippets_domain_model_category',
				'foreign_table_where' => 'ORDER BY tx_t3osnippets_domain_model_category.title',
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'int,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext[]',
		),
		'author' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.author',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY fe_users.username',
				'items' => array(
					array('', 0)
				),
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'eval' => 'int'
			),
		),
		'code' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.code',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			)
		),
		'tags' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet.tags',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
	),
);
?>