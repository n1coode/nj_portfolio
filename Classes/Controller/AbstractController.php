<?php
namespace N1coode\NjPortfolio\Controller;
use N1coode\NjPortfolio\Utility\Constants as Constants;
use N1coode\NjPortfolio\Utility\Configuration;

/**
 * Abstract base controller for the extension Tx_NjPortfolio
 * @author n1coode
 * @package nj_portfolio
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	/**
     * @var array
     */
    protected $arguments = array();
	
	/**
	 * @var array 
	 */
	protected $error = [];
	
	/**
	 * @var array 
	 */
	protected $exceptions = [];
	
	/**
	 * @var string
	 */
	protected $nj_action = '';
	
	/**
	 * @var string
	 */
	protected $nj_ajax_pageType = Constants::NJ_AJAX_PAGETYPE;
	
	/**
	 * @var string
	 */
	protected  $nj_domain = '';
	
	/**
	 * @var string
	 */
	protected $nj_domain_model = '';

	/**
	 * @var string
	 */
	protected $nj_ext_domain = Constants::NJ_EXT_DOMAIN;
	
	/**
	 * @var string
	 */
	protected $nj_ext_key = Constants::NJ_EXT_KEY;
	
	/**
	 * @var string
	 */
	protected $nj_ext_listtype = Constants::NJ_EXT_LISTTYPE;
	
	/**
	 * @var string
	 */
	protected $nj_ext_namespace = Constants::NJ_EXT_NAMESPACE;
	
	/**
	 * @var string
	 */
	protected $nj_ext_path = Constants::NJ_EXT_PATH;
	
	/**
	 * @var array
	 */
	protected $nj_settings = [];
	
	/**
	 * @var \TYPO3\CMS\Core\Page\PageRenderer
	 * @inject
	 */
	protected $pageRenderer;
	
	
	/**
	 * @var int
	 */
	protected $storagePid;
	
	/**
	 * @var boolean
	 */
	protected $useTyposcript = false;
	
	
	//
	// Repositories
	//
	
	/**
	 * @var \TYPO3\CMS\Core\Resource\FileRepository
	 * @inject
	 */
	protected $fileRepository;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\ClientRepository
	 * @inject
	 */
	protected $clientRepository = NULL;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\TradeRepository
	 * @inject
	 */
	protected $tradeRepository = NULL;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\WorkRepository
	 * @inject
	 */
	protected $workRepository = NULL;
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Repository\PortfolioRepository
	 * @inject
	 */
	protected $portfolioRepository = NULL;
    
	
	//
	// Manager, Renderer & Services
	//
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;
	
	/**
	 * Holds an instance of persistence manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;
	
	/**
	 * 
	 * @param string $model
	 * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
	 * @throws \TYPO3\CMS\Extbase\Configuration\Exception
	 */
	protected function init()
	{
		if($this->nj_domain_model !== null)
		{
			$this->nj_domain = strtolower($this->nj_domain_model);
			$this->nj_action = $this->request->getControllerActionName();
			
			$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
			
			if(\N1coode\NjCollection\Utility\Configuration::flexformSettingsExists($this->configurationManager))
			{
				\N1coode\NjCollection\Utility\Configuration::settings($this->configurationManager);
			}
			
			$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			
			$this->settings = $configuration['settings'];
			
			unset($this->settings['flexform']);
		}
		else
		{
			throw new \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
				('Kein Model angegeben. Überprüfe die Controller-Klasse.',48246892768209576);
		}
		
		if(!isset($this->settings))
			throw new \TYPO3\CMS\Extbase\Configuration\Exception('Please include typoscript to enable the extension.', 48246892768209576 );
		
		//if(isset($configuration['persistence']['storagePid']))
		//	$this->storagePid = intval($configuration['persistence']['storagePid']);		
		$this->includeJavaScript();
	}
	
	
	
	
	protected function callActionMethod() 
	{
		Try {
			parent::callActionMethod();
		} Catch(Exception $e) {
			$this->response->appendContent($e->getMessage());
		}
	}
	
	
	protected function getExtSettings()
	{
		$extSettings = [];
		$extSettings['action']		= explode('Action',self::getCaller())[0];
		$extSettings['controller']	= $this->nj_domain_model;	
		$extSettings['domain']		= $this->nj_domain;	
		$extSettings['key']			= $this->nj_ext_key;
		$extSettings['langFile']	= 'LLL:EXT:'.$this->nj_ext_path.'/Resources/Private/Language/locallang.xlf:';
		$extSettings['language']	= $GLOBALS['TSFE']->sys_language_uid;
		$extSettings['name']		= strtolower($this->nj_ext_namespace);
		$extSettings['pageId']		= $GLOBALS['TSFE']->page['uid'];
		if(isset($this->settings['general']['ajax']['typeNum']))
		{
			$extSettings['typeNum']	= $this->settings['general']['ajax']['typeNum'];
		}

		if($this->nj_domain === 'work')
		{
			if($this->nj_action === 'digest')
			{
				if(isset($this->settings['model'][$this->nj_domain][$this->nj_action]['category']['default']))
				{
					$extSettings['defaultCategory']	= $this->settings['model'][$this->nj_domain][$this->nj_action]['category']['default'];
				}
			}
			
		}
		
		
		return $extSettings;
	}
	
	protected function initArguments()
    {
        $this->arguments = $this->request->getArguments();
    }

	/**
	 * @param \String $controller
	 * @param \String $action
	 * @param \String $format
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView
	 */
	protected function initViewAjax($controller, $action, $format)
	{
		$view = $this->objectManager->create('TYPO3\CMS\Fluid\View\StandaloneView');
		$view->setFormat($format);
		$view->setTemplatePathAndFilename(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:nj_portfolio/Resources/Private/Templates/'.$controller.'/'.ucfirst($action).'.'.$format));
		$view->setPartialRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:nj_portfolio/Resources/Private/Partials/'));
		$view->setLayoutRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:nj_portfolio/Resources/Private/Layouts/'));
		
		return $view;
	}
	
	private function includeJavaScript() 
	{
		if($this->nj_domain === 'work')
		{
			if($this->nj_action === 'digest')
			{
				$this->getPageRenderer()
					->addJsFooterFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('nj_collection') . 'Resources/Public/Javascript/Lib/jquery/plugins/jquery.imagesloaded.pkgd.min.js');
				$this->getPageRenderer()
					->addJsFooterFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('nj_collection') . 'Resources/Public/Javascript/Lib/jquery/plugins/jquery.masonry.pkgd.min.js');
			}
		}
		$this->getPageRenderer()
			->addJsFooterFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/'.$this->nj_ext_key.'_frontend.js');
	}
	
	
	protected function setExtSettings()
	{
		$extSettings = [];
		$extSettings['action']						= explode('Action',self::getCaller())[0];
		$extSettings['typeNum']						= $this->settings['general']['ajax']['typeNum'];
		//$extSettings['ajax']['path']['partial']		= $this->settings['view']['partialRootPath'];
		//$extSettings['ajax']['path']['template']	= $this->settings['view']['templateRootPath'];
		$extSettings['controller']					= $this->nj_domain_model;		
		$extSettings['domain']						= $this->nj_domain;
		$extSettings['key']							= $this->nj_ext_key;
		$extSettings['langFile']					= 'LLL:EXT:'.$this->nj_ext_path.'/Resources/Private/Language/locallang.xlf:';
		$extSettings['language']					= $GLOBALS['TSFE']->sys_language_uid;
		$extSettings['name']						= strtolower($this->nj_ext_namespace);
		$extSettings['pageId']						= $GLOBALS['TSFE']->page['uid'];

		
		return $extSettings;
	}
	
	
	protected function getCaller() 
	{
		$trace = debug_backtrace();
		$name = $trace[2]['function'];
		return empty($name) ? 'global' : $name;
	}
	
	
	private function includeCss()
	{
		$cssFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Css/'.$this->nj_ext_key.'.css';
					
		//if(!empty($this->settings['model'][strtolower($model)]['cssFile']))
		//{
		//	$cssFile = $this->settings['model'][strtolower($model)]['cssFile'];
		//}
		//$GLOBALS['TSFE']->getPageRenderer()->addCssFile($cssFile);
	}
	
	
	protected function storagePidIsset()
	{
		if(isset($this->settings['persistence']['storagePid']))
		{
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Provides a shared (singleton) instance of PageRenderer
	 *
	 * @return \TYPO3\CMS\Core\Page\PageRenderer
	 */
	protected function getPageRenderer() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
	}
	
	
	/**
	 * var_dump
	 */
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($frameworkConfiguration, 'Configuration -> $frameworkConfiguration');
	
	
	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $works
	 * @return array $worksCollection
	 */
	protected function buildWorksCollection($works)
	{
		
		
		/**
		 * The collection of random works that will be assigned to the list view
		 * @var array
		 */
	   $worksCollection = [];
	   
	   foreach($works as $work)
	   {
		   $images = $work->getImages();
		   if(count($images) > 0)
		   {
			   shuffle($images);
			   $work->setPreviewImage($images[0]);
			   $worksCollection[] = $work;
		   }
		   
	   }
	   return $worksCollection;
	}
	
	
} //end of class Tx_NjPortfolio_Controller_AbstractController