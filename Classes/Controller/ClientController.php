<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class ClientController extends \N1coode\NjPortfolio\Controller\AbstractController
{
	/**
	 * @var integer
	 */
	protected $uid;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\ClientRepository
	 */
	protected $clientRepository;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;
	
	/**
   + * Dependency injection of the Client Repository
	 *
	 * @param \N1coode\NjPortfolio\Domain\Repository\ClientRepository $clientRepository
	 * @return void
   - */
	public function injecWorkRepository(\N1coode\NjPortfolio\Domain\Repository\ClientRepository $clientRepository)
	{
		$this->clientRepository = $clientRepository;
	}
	
	/**
   + * Dependency injection of the ConfigurationManager Interface
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return void
   - */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		$this->configurationManager = $configurationManager;
	}
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Client');
	}
	
} //end of class Tx_NjPortfolio_Controller_ClientController
?>