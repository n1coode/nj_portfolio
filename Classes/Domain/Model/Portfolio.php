<?php
namespace N1coode\NjPortfolio\Domain\Model;

/**
 * A portfolio
 * @author n1coode
 * @package nj_portfolio
 */
class Portfolio extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{	
	/**
	 * @var \string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $title;
	
	
	/**
	 * The work of this portfolio
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Work>
	 * @lazy
	 * @cascade remove
	 */
	protected $work;
	
	
	/* ***************************************************** */
	
	/**
	 * Constructs a new portfolio
	 *
	 */
	public function __construct() 
	{
	}
	
	/* ***************************************************** */
	
	
	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Getter for title
	 *
	 * @return \string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	
	/**
	 * Adds a work to this portfolio
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Work $newWork
	 * @return void
	 */
	public function addWork(\N1coode\NjPortfolio\Domain\Model\Work $newWork) 
	{
		$this->work->attach($newWork);
	}
	
	/**
	 * Remove a work from this portfolio
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Work $workToRemove The work to be removed
	 * @return void
	 */
	public function removeWork(\N1coode\NjPortfolio\Domain\Model\Work $workToRemove) 
	{
		$this->work->detach($workToRemove);
	}
	
	/**
	 * Remove all work from this portfolio
	 *
	 * @return void
	 */
	public function removeAllWork() 
	{
		$this->work = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}
	
	/**
	 * Returns all work of this portfolio
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getWork() 
	{
		return $this->work;
	}
	
} //end of class Tx_NjPortfolio_Domain_Model_Portfolio
?>