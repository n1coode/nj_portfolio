<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class CategoryController extends \N1coode\NjPortfolio\Controller\AbstractController
{
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
	 * List action for this controller. Displays the portfolio according to a given StoragePid.
	 *
	 * @return void
	 */
	public function listAction()
	{
		$this->nj_action = \N1coode\NjCollection\Utility\General::getActionName(__FUNCTION__);
		
		$assignValues = [];
		$assignValues['ext'] = $this->getExtSettings();
		
		$categories =  $this->categoryRepository->findAll();
		if(count($categories) > 0)
		{
			$assignValues['categories'] = $categories;
		}
		$this->view->assignMultiple($assignValues);
	}
	
	/**
	 * List action for this controller. Displays the portfolio according to a given StoragePid.
	 *
	 * @return void
	 */
	public function menuAction()
	{
		$assignValues = [];
		
		$this->nj_settings = \N1coode\NjCollection\Utility\General::getActionVersion($this->settings, $this->getExtSettings());
		$assignValues['ext'] = $this->nj_settings;
		
		$categories =  $this->categoryRepository->findAll();
		if(count($categories) > 0)
		{
			$assignValues['categories'] = $categories;
		}
		$this->view->assignMultiple($assignValues);
	}
	
} //end of class Tx_NjPortfolio_Controller_CategoryController