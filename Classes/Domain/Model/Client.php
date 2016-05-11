<?php
namespace N1coode\NjPortfolio\Domain\Model;

/**
 * A client
 * @author n1coode
 * @package nj_portfolio
 */
class Client extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var string
	 */
	protected $cdColorBack = '';
	
	
	/**
	 * @var string
	 */
	protected $cdColorFront = '';
	
	
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $logo;
	
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $name;
	
	
	/**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Trade>
     */
	protected $trades;
	
	
	/**
	 * @var string
	 */
	protected $website;
	
	/* ***************************************************** */

	/**
	 * Constructs a new client
	 *
	 */
	public function __construct() {

	}

	/* ***************************************************** */

	
	/**
	 * Sets the description
	 *
	 * @param string $cdColorBack
	 * @return void
	 */
	public function setCdColorBack($cdColorBack)
	{
		$this->cdColorBack = $cdColorBack;
	}
	
	/**
	 * Getter for the description
	 *
	 * @return string
	 */
	public function getCdColorBack()
	{
		return $this->cdColorBack;
	}
	
	
	/**
	 * Sets the description
	 *
	 * @param string $cdColorFront
	 * @return void
	 */
	public function setCdColorFront($cdColorFront)
	{
		$this->cdColorFront = $cdColorFront;
	}
	
	/**
	 * Getter for the description
	 *
	 * @return string
	 */
	public function getCdColorFront()
	{
		return $this->cdColorFront;
	}
	
	
	/**
	 * Setter for the logo
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
	 * @return void
	 */
	public function setLogo($logo)
	{
		$this->logo = $logo;
	}
	
	/**
	 * Getter for the logo
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getLogo()
	{
		return $this->logo;
	}
	
	
	/**
	 * Sets the name of the client
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * Getter for the name of the client
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	
	/**
     * Getter for the trade
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Trade>
     */
    public function getTrades()
    {
        return $this->trades;
    }
	
	
	/**
	 * Sets the name of the client
	 *
	 * @param string $website
	 * @return void
	 */
	public function setWebsite($website)
	{
		$this->website = $website;
	}
	
	/**
	 * Getter for the name of the client
	 *
	 * @return string
	 */
	public function getWebsite()
	{
		return $this->website;
	}
	
} //end of class Tx_NjPortfolio_Domain_Model_Client
?>