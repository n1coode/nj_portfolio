<?php
namespace N1coode\NjPortfolio\Utility;


/**
 * @author n1coode
 * @package nj_portfolio
 */
class Configuration
{
	/**
	 * @var string
	 */
	protected $nj_ext_namespace = \N1coode\NjPortfolio\Utility\Constants::NJ_EXT_NAMESPACE;

	/**
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return array
	 */
	public static function settings(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		$flexformSettingsExists = false;
		$useTypoScript = false;
		
		$frameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		
		if(array_key_exists('flexform', $frameworkConfiguration['settings']))
		{
			$flexformSettingsExists = true;
		}
		
		if($flexformSettingsExists)
		{
			if($frameworkConfiguration['settings']['flexform']['general']['typoScript'] == 1)
			{
				$useTypoScript = true;
			}
			else
			{
				$flexform = $frameworkConfiguration['settings']['flexform'];
				foreach($flexform['general'] as $key=>$value)
				{
					$frameworkConfiguration['settings']['general'][$key] = $value;
				}
				foreach($flexform['persistence'] as $key=>$value)
				{
					$frameworkConfiguration['persistence'][$key] = $value;
				}
				foreach($flexform['model'] as $key=>$value)
				{
					$frameworkConfiguration['settings']['model'][$key] = $value;
				}
		
				unset($frameworkConfiguration['settings']['flexform']);
			}
		}
		else
		{
			$useTypoScript = true;
		}
		
		if($useTypoScript)
		{
			//nothing todo
		}
		
		return $frameworkConfiguration;

	} //end of function settings
	
	
} //end of N1coode\NjPortfolio\Utility\Configuration