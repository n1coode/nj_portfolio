<?php
namespace N1coode\NjPortfolio\ViewHelpers;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class NavNeededViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * 
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Portfolio $work
	 * @return \integer
	 */
	public function render(\N1coode\NjPortfolio\Domain\Model\Work $work)
	{
		$tmp = 0;
 		$numberOfImages = 0;
 		
 		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($portfolio);
 		foreach($work as $workItem) 
 		{
 			$numberOfImages += count($workItem->getImages());
 		}
 		if($numberOfImages > 0) $tmp = 1;
		
		return $tmp;
	}
	
} //end of class Tx_NjPortfolio_ViewHelpers_NavNeededViewHelper