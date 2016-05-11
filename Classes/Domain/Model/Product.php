<?php
namespace N1coode\NjPortfolio\Domain\Model;

/**
 * A product
 * @author n1coode
 * @package nj_portfolio
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $description = '';
	
	
	/* ***************************************************** */

	/**
	 * Constructs a new product
	 *
	 */
	public function __construct() {

	}

	/* ***************************************************** */

	
	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Getter for the title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	
	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	/**
	 * Getter for the description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
} //end of class N1coode\NjPortfolio\Domain\Model\Product
?>