<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'List',
	'Snippets'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Snippets');

t3lib_extMgm::addLLrefForTCAdescr('tx_t3osnippets_domain_model_snippet', 'EXT:t3o_snippets/Resources/Private/Language/locallang_csh_tx_t3osnippets_domain_model_snippet.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_t3osnippets_domain_model_snippet');
$TCA['tx_t3osnippets_domain_model_snippet'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_snippet',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,category,description,author,code,tags',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Snippet.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/snippet.gif'
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_t3osnippets_domain_model_category');
$TCA['tx_t3osnippets_domain_model_category'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xml:tx_t3osnippets_domain_model_category',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/snippet.gif'
	),
);
?>