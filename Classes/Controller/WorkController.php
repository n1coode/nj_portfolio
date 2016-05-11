<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class WorkController extends \N1coode\NjPortfolio\Controller\AbstractController
{
	/**
	 * @var integer
	 */
	protected $uid;
	
	
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
	 * @return string $show The initial selection.
	 */
	function getSelectionStart()
	{
		$show = 'clients';
		
		$selectionItems = $this->getSelection();
		
		if(isset($this->settings['model'][$this->nj_domain][$this->nj_action]['selection']['start']))
		{
			$item = $this->settings['model'][$this->nj_domain][$this->nj_action]['selection']['start'];
			
			if(!empty($selectionItems))
			{
				if(in_array($item,$selectionItems))
				{
					$show = $item;
				}
			}
		}
		return $show;
	}
	
	function getSelection()
	{
		$selectionItems = [];
		if(isset($this->settings['model'][$this->nj_domain][$this->nj_action]['selection']['items']))
		{
			$selectionItems = explode(',',$this->settings['model'][$this->nj_domain][$this->nj_action]['selection']['items']);
		}
		return $selectionItems;
	}
	
	
	/**
	 * Index action for this controller.
	 */
	public function digestAction()
	{	
		
		$assignValues = [];
		
		$this->nj_settings = \N1coode\NjCollection\Utility\General::getActionVersion($this->settings, $this->getExtSettings());
		$assignValues['ext'] = $this->nj_settings;
		
		/**
		 * get initial selection
		 */
		$show = $this->getSelectionStart();
		if($show !== '')
		{
			$assignValues['selection'] = $this->getSelection();
			$assignValues['render'] = ucfirst($show);
		}

		$clients = $this->clientRepository->findAll();
		
		if(count($clients) > 0)
		{
			/**
			 * The collection of random works that will be assigned to the list view
			 * @var array
			 */
			$worksCollection = [];
			
			foreach($clients as $client)
			{
				$randomWork = [];
				$randomWork['client'] = $client;
				$works = $this->workRepository->findByClient($client);
				
				if(count($works) > 0)
				{
					$randomWork['work'] = $this->getRandomImage($this->worksImagesToArray($works));
					//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($randomWork);
					
					if($randomWork['work'] instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference)
					{
						$worksCollection[] = $randomWork;
					}
				}
				
			} //end of foreach clients
			
			shuffle($worksCollection);
			
			$assignValues['colWidth'] = 1920 / 4;   //TODO (settings)
			
			if(count($worksCollection) > 0)
			{
				$assignValues['works'] = $worksCollection;
			}
		}
		
		$this->view->assignMultiple($assignValues);
	}
	
	
	/**
	 * List action for this controller. Displays the portfolio according to a given StoragePid.
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Portfolio $portfolio
	 * @return void
	 */
	public function listAction(\N1coode\NjPortfolio\Domain\Model\Portfolio $portfolio = null)
	{
		
		$clients = $this->clientRepository->findAll();
		
		/**
		 * The collection of random works that will be assigned to the list view
		 * @var array
		 */
		$worksCollection = [];
		
		
		
		if(\count($clients) > 0)
		{
			foreach($clients as $client)
			{
				$randomWork = [];
				$randomWork['client'] = $client;
				$works = $this->workRepository->findByClient($client);
				
				if(\count($works) > 0)
				{
					$randomWork['work'] = $this->getRandomImage($this->worksImagesToArray($works));
					if(is_object($randomWork))
					{
						$worksCollection[] = $randomWork;
					}
				}

				
			} //end of foreach clients
			
			shuffle($worksCollection);
			$this->view->assign("works", $worksCollection);
		}
		
	}
	
	
	
	public function selectionAction()
	{
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->view->getRequest());
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
	
	
	/**
	 * List action for this controller. Displays the portfolio according to a given StoragePid.
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Work $work
	 * @return void
	 */
	public function focusSingleAction(\N1coode\NjPortfolio\Domain\Model\Work $work = null)
	{
		
	}
	
	/**
	 * List action for this controller. Displays the works according to a given client.
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Client $client
	 * @return void
	 */
	public function focusClientAction(\N1coode\NjPortfolio\Domain\Model\Client $client = null)
	{
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->view->getRequest());
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();
		
		$assignValues['client'] = $client;
		$assignValues['works'] = $this->workRepository->findByClient($client);
		
		$this->view->assignMultiple($assignValues);
	} 
	
	
	public function highlightsAction()
	{
		$works = $this->workRepository->findByHighlight(1);
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();
		$assignValues['works'] = $works;		
		$this->view->assignMultiple($assignValues);
	}
	
	
	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $works
	 * @return array
	 */
	private function worksImagesToArray(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $works)
	{
		$imageCollection = [];
		foreach($works as $work)
		{
			$images = $work->getImages();
			if(\count($images) > 0)
			{ 
				$imageCollection = \array_merge($imageCollection, $images);
			}
		}
		
		return $imageCollection;
	}
	
	
	function collectImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
		{
			$imageCollection = [];
			foreach($images as $image)
			{
				$imageCollection[] = $image;
			} 
			return $imageCollection;
		}
	
	
	
	/**
	 * 
	 * @param array $images
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $randomImage
	 */
	private function getRandomImage(array $images)
	{
		if(\count($images) > 0)
		{
			$random = \rand(0, \count($images) - 1);
			return $images[$random];
		}
		
		return \NULL;
	}
	
} //end of class Tx_NjPortfolio_Controller_WorkController