<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Sven Burkert <bedienung@sbtheke.de>, SBTheke web development
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package t3o_snippets
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_T3oSnippets_Controller_SnippetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * snippetRepository
	 *
	 * @var Tx_T3oSnippets_Domain_Repository_SnippetRepository
	 */
	protected $snippetRepository;

	/**
	 * injectSnippetRepository
	 *
	 * @param Tx_T3oSnippets_Domain_Repository_SnippetRepository $snippetRepository
	 * @return void
	 */
	public function injectSnippetRepository(Tx_T3oSnippets_Domain_Repository_SnippetRepository $snippetRepository) {
		$this->snippetRepository = $snippetRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$arguments = $this->request->getArguments();
		if(!array_key_exists('order', $arguments)) {
			$arguments['order'] = 'title:ASC';
		}
		$order = explode(':', $arguments['order']);
		$snippets = $this->snippetRepository->findAllSorted(
			array($order[0] => ($order[1] == 'ASC' ? Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING : Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING))
		);
		$this->view->assign('snippets', $snippets);
	}

	/**
	 * action show
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $snippet
	 * @return void
	 */
	public function showAction(Tx_T3oSnippets_Domain_Model_Snippet $snippet) {
		#$snippet->setAuthor($this->objectManager->get('Tx_T3oSnippets_Domain_Repository_AuthorRepository')->findByUid($snippet->getUid()));
		#$snippet->setCategory($this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findByUid($snippet->getCategory()));
		#$codeClipboard = str_replace(array(PHP_EOL, "'"), array('\n', "\'"), $snippet->getCode());
		#$codeClipboard = htmlspecialchars($snippet->getCode());
		$GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . '_mainJs'] = '<script type="text/javascript" src="' . $GLOBALS['TSFE']->tmpl->getFileName($this->settings['pathToMainJs']) . '"></script>';
		$GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . '_zeroClipboardJs'] = '<script type="text/javascript" src="' . $GLOBALS['TSFE']->tmpl->getFileName($this->settings['pathToZeroClipboardJs']) . '"></script>';
		$GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . '_zeroClipboardSwf'] = '<script type="text/javascript">ZeroClipboard.setMoviePath("' . $GLOBALS['TSFE']->tmpl->getFileName($this->settings['pathToZeroClipboardSwf']) . '");</script>';

		if($snippet->getAuthor()) {
			$this->view->assign('authorSnippets', $this->snippetRepository->findAllAuthor($snippet->getAuthor()));
		}
		$this->view->assign('codeClipboard', $codeClipboard);
		$this->view->assign('codeGeshi', $this->codeGeshi($snippet->getCode(), $snippet->getCategory()->getTitle()));
		$this->view->assign('snippet', $snippet);
		$this->view->assign('tags', t3lib_div::trimExplode(',', $snippet->getTags()));
	}

	/**
	 * action category
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Category $category
	 * @return void
	 */
	public function categoryAction(Tx_T3oSnippets_Domain_Model_Category $category) {
		$snippets = $this->snippetRepository->findAllCategory($category);
		$this->view->assign('snippets', $snippets);
		$this->view->assign('category', $category);
	}

	/**
	 * action tag
	 *
	 * @param string $tag
	 * @return void
	 */
	public function tagAction($tag) {
		$snippets = $this->snippetRepository->findAllTag($tag);
		$this->view->assign('snippets', $snippets);
		$this->view->assign('tag', $tag);
	}

	/**
	 * action author
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Author $author
	 * @return void
	 */
	public function authorAction($author) {
		$snippets = $this->snippetRepository->findAllAuthor($author);
		$this->view->assign('snippets', $snippets);
		$this->view->assign('author', $author);
	}

	/**
	 * action new
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $newSnippet
	 * @dontvalidate $newSnippet
	 * @return void
	 */
	public function newAction(Tx_T3oSnippets_Domain_Model_Snippet $newSnippet = NULL) {
		$this->view->assign('newSnippet', $newSnippet);
		$this->view->assign('categories', $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findAll());
		$this->view->assign('tags', $this->getTags());
	}

	/**
	 * action create
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $newSnippet
	 * @return void
	 */
	public function createAction(Tx_T3oSnippets_Domain_Model_Snippet $newSnippet) {
		if($GLOBALS['TSFE']->loginUser) {
			$author = $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_AuthorRepository')->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
			$newSnippet->setAuthor($author);
		}
		$this->snippetRepository->add($newSnippet);
		$this->flashMessageContainer->add('Your new Snippet was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $snippet
	 * @dontvalidate $snippet
	 * @return void
	 */
	public function editAction(Tx_T3oSnippets_Domain_Model_Snippet $snippet) {
		$this->view->assign('snippet', $snippet);
		$this->view->assign('categories', $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findAll());
	}

	/**
	 * action update
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $snippet
	 * @return void
	 */
	public function updateAction(Tx_T3oSnippets_Domain_Model_Snippet $snippet) {
		$this->snippetRepository->update($snippet);
		$this->flashMessageContainer->add('Your Snippet was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param Tx_T3oSnippets_Domain_Model_Snippet $snippet
	 * @return void
	 */
	public function deleteAction(Tx_T3oSnippets_Domain_Model_Snippet $snippet) {
		$this->snippetRepository->remove($snippet);
		$this->flashMessageContainer->add('Your Snippet was removed.');
		$this->redirect('list');
	}

	/**
	 * @return \TYPO3\Flow\Error\Message
	 */
	protected function getErrorFlashMessage() {
		switch($this->actionMethodName) {
			case 'createAction':
				return false;
			break;
			default:
				return parent::getErrorFlashMessage();
			break;
		}
	}

	/**
	 * Return all available tags
	 *
	 * @return array: tags
	 */
	protected function getTags() {
		$tags = array();
		foreach($this->snippetRepository->findAll() as $snippet) {
			if($snippet->getTags()) {
				foreach(t3lib_div::trimExplode(',', $snippet->getTags()) as $tag) {
					$tags[] = $tag;
				}
			}
		}
		$tags = array_unique($tags);
		sort($tags);
		return $tags;
	}

	/**
	 * Highlight code with GeSHi
	 *
	 * @param string $code: Code to highlight
	 * @param string $language: Type of code, e.g. "php", "typoscript", "html4strict", ...
	 */
	protected function codeGeshi($code, $language) {
		require_once(t3lib_extMgm::siteRelPath('geshilib') . 'res/geshi.php');
		$geshi = new GeSHi($code, $language, '');
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
		$geshi->enable_classes(true);
		$geshi->set_overall_id($this->settings['codeGeshiId']);
		$GLOBALS['TSFE']->additionalCSS[$this->request->getControllerExtensionKey() . '_geshiCss'] = $geshi->get_stylesheet();
		return $geshi->parse_code();
	}

}
?>
