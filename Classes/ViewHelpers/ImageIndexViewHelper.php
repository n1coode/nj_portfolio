<?php
namespace N1coode\NjPortfolio\ViewHelpers;
 
/**
 * @author n1coode
 * @package nj_portfolio
 */
class ImageIndexViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * Sets the Iterator.index + 1 for display.
	 *
	 * @param int $iterator
	 * 
	 * @return int
	 */
	public function render($iterator)
	{
		return 1000 - $iterator;
	}

} //end of class Tx_NjPortfolio_ViewHelpers_ImageIndexViewHelper

