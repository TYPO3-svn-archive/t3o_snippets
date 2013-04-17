<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'List',
	array(
		'Snippet' => 'list, show, new, create, edit, update, delete, category, tag, author',
	),
	// non-cacheable actions
	array(
		'Snippet' => 'create, update, delete',
	)
);

?>