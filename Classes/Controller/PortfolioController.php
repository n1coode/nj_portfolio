<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class PortfolioController extends \N1coode\NjPortfolio\Controller\AbstractController
{
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Portfolio');
	}
	
} //end of class Tx_NjPortfolio_Controller_WorkController