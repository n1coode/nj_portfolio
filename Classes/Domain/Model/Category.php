<?php
namespace N1coode\NjPortfolio\Domain\Model;

/**
 * A category
 * @author n1coode
 * @package nj_portfolio
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $title;
	
	/**
	 * The description of the category.
	 *
	 * @var string
	 */
	protected $description = '';
	
	/**
	 * @var string
	 */
	protected $icon = '';
	
	
	/**
	 * @var string
	 */
	protected $iconInclude = '';
	
	
	/* ***************************************************** */

	/**
	 * Constructs a new work
	 *
	 */
	public function __construct() {

	}

	/* ***************************************************** */
	
	/**
	 * Setter for the icon
	 *
	 * @param string $icon
	 * @return void
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}
	
	/**
	 * Getter for the icon
	 *
	 * @return string
	 */
	public function getIcon()
	{
		return $this->icon;
	}
	
	
	/**
	 * Setter for option to include icon or not
	 *
	 * @param int $iconInclude
	 * @return void
	 */
	public function setIconInclude($iconInclude)
	{
		$this->iconInclude = $iconInclude;
	}
	
	/**
	 * Getter for option to include icon or not
	 *
	 * @return int
	 */
	public function getIconInclude()
	{
		return $this->iconInclude;
	}
	
	
	
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
	
} //end of class Tx_NjPortfolio_Domain_Model_Category
?>