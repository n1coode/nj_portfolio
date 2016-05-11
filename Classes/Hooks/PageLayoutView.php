<?php
namespace N1coode\NjPortfolio\Hooks;
use N1coode\NjPortfolio\Service\Constants as Constants;
/**
 * @author n1coode
 * @package nj_portfolio
 */
class PageLayoutView implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface 
{
    /**
     * Preprocesses the preview rendering of a content element.
     *
     * @param PageLayoutView $parentObject Calling parent object
     * @param boolean $drawItem Whether to draw the item using the default functionalities
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     * @return void
     */
    public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {

        //depending on your list type!!
        if ($row['list_type'] !== 'njportfolio_pi1') {
            return;
        }

		$pluginTitle = $GLOBALS['LANG']->sL(Constants::NJ_EXT_LANG_FILE_BACKEND.'plugin.title');
		$headerContent = '<b>'.$pluginTitle.'</b>';
		
		if(is_string($row['pi_flexform']))
		{
			$flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($row['pi_flexform']);
		
			$controllerActions = $flexform['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];

			if($controllerActions !== NULL)
			{
				$controllerActionsExplode = explode('->', $controllerActions);


				if(count($controllerActionsExplode === 2))
				{
					$action = $controllerActionsExplode[0];
					$controller = $controllerActionsExplode[1];

					
					
					
					$pluginTitle = $GLOBALS['LANG']->sL(Constants::NJ_EXT_LANG_FILE_BACKEND.'plugin.title');
					$headerContent .= '<br><span style="background-color:black;color:white;padding:0 5px;">'.$action.' ::: '.$controller . '</span>';
				
				}
			}
		}
		
        $drawItem = FALSE;
        
		

		

        //we are in a Hook, make instance by your own pls ^^//
        /** @var $extbaseObjectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
        $extbaseObjectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');

        
        $itemContent.= '';
  }
}