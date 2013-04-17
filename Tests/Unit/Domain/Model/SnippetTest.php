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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_T3oSnippets_Domain_Model_Snippet.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Snippets
 *
 * @author Sven Burkert <bedienung@sbtheke.de>
 */
class Tx_T3oSnippets_Domain_Model_SnippetTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_T3oSnippets_Domain_Model_Snippet
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_T3oSnippets_Domain_Model_Snippet();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForIntegerSetsCategory() { 
		$this->fixture->setCategory(12);

		$this->assertSame(
			12,
			$this->fixture->getCategory()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getAuthorReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setAuthorForIntegerSetsAuthor() { 
		$this->fixture->setAuthor(12);

		$this->assertSame(
			12,
			$this->fixture->getAuthor()
		);
	}
	
	/**
	 * @test
	 */
	public function getCodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCodeForStringSetsCode() { 
		$this->fixture->setCode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCode()
		);
	}
	
	/**
	 * @test
	 */
	public function getTagsReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTagsForStringSetsTags() { 
		$this->fixture->setTags('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTags()
		);
	}
	
}
?>