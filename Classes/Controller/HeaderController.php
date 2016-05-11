<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class HeaderController extends \N1coode\NjPortfolio\Controller\AbstractController
{
	/**
	 * @var array 
	 */
	private $actionSettings = [];
	
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		$this->nj_domain_model = \N1coode\NjCollection\Utility\General::getShortClassName(__CLASS__);
		$this->init();
	}
	
	/**
	 * @return void
	 */
	public function indexAction()
	{
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->view->getRequest());
		$assignValues = [];
		$extSettings = $this->getExtSettings();
		$extSettings['version'] = 
		
		$this->actionSettings = $this->settings['model']['header']['index'];
		
		$version = $this->actionSettings['version'];
		if($version !== NULL && $version !== '')
		{
			$extSettings['version'] = $version;
		}
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
}