<?php
namespace N1coode\NjPortfolio\ViewHelpers;
 
/**
 * @author n1coode
 * @package nj_portfolio
 */
class MenuNumberViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * Sets the Iterator.index + 1 for display.
	 *
	 * @param int $iterator
	 * @return string
	 */
	public function render($iterator)
	{
		$tmp = '';
		if(($iterator + 1) < 10) $tmp .= '0';
		$tmp .= $iterator + 1;
		
		return $tmp;
	}

} //end of class Tx_NjPortfolio_ViewHelpers_MenuNumberViewHelper