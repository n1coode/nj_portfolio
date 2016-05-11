<?php
namespace N1coode\NjPortfolio\Controller;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class AjaxController extends \N1coode\NjPortfolio\Controller\AbstractController
{
	/**
	 * @var array 
	 */
	protected $assignValues = [];
	
    /**
     * @var \TYPO3\CMS\Fluid\View\StandaloneView
     */
    protected $viewFilter;

    /**
     * @var \TYPO3\CMS\Fluid\View\StandaloneView
     */
    protected $viewContent;
        
	
	/**
	 * @var \TYPO3\CMS\Extbase\Service\ImageService
	 * @inject
	 */
	protected $imageService;
	
	/**
	 * @var boolean 
	 */
	protected $success = false;
    
    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        $this->nj_domain_model = \N1coode\NjCollection\Utility\General::getShortClassName(__CLASS__);
		$this->init();
		$this->assignValues['isAjax'] = 1;
    }
	
	public function workDigestAction()
	{
		$this->nj_settings = \N1coode\NjCollection\Utility\General::getActionVersion($this->settings, $this->getExtSettings());
		$this->assignValues['ext'] = $this->nj_settings;
		
		$this->initArguments();
		
		switch($this->arguments['call'])
		{
			case 'Categories':
				$this->assignValues['render'] = $this->arguments['call'];
				$this->workDigestCallCategories();
				break;
			default:
				$this->workDigestCallDefault();
		}
		
		$this->view->assignMultiple($this->assignValues);
		
		return json_encode( 
            array(
				"call" => $this->arguments['call'],
				"container" => $this->arguments['show'],
                "success" => $this->success,
                "content" => $this->view->render()
			)
        );
	}
	
	private function workDigestCallCategories()
	{
		if(isset($this->arguments['show']) && $this->arguments['show'] > 0)
		{
			$category = $this->categoryRepository->findByUid($this->arguments['show']);
			$this->digestAssignWorksByCategories($this->arguments['show']);
			$this->assignValues['noMenu'] = 1;
		}
	}
	
	
	private function workDigestCallDefault()
	{
		if(!empty($this->arguments))
		{ 
			$this->assignValues['arguments'] = $this->arguments; 
			
			if(isset($this->arguments['show']) && $this->arguments['show'] !== '')
			{
				/**
				 * Call function depending on given value $this->arguments['show']
				 */
				$this->assignValues['render'] = ucfirst($this->arguments['show']);
				$method = 'digestAssignWorksBy'.ucfirst($this->arguments['show']);
				switch($this->arguments['show'])
				{
					case 'categories':
						$this->$method($this->arguments['activeCategory']);
						break;
					default:
						$this->$method();
				}
			}
		}
		
		$this->assignValues['colWidth'] = 1920 / 4;
	}
	
	
	private function digestAssignWorksByCategories($categoryUid)
	{
		$this->assignValues['activeCategory'] = $categoryUid;
		
		$categories =  $this->categoryRepository->findAll();
		if(count($categories) > 0)
		{
			$this->assignValues['categories'] = $categories;
			$this->success = true;
		}
		
		if($categoryUid > 0)
		{
			$works = $this->workRepository->findAllByCategory($this->categoryRepository->findByUid($categoryUid));
			
			$worksCollection = $this->buildWorksCollection($works);
			
			if(count($worksCollection) > 0)
			{
				$this->assignValues['works'] = $worksCollection;
			}
		}
	}
	
	
	private function digestAssignWorksByClients()
	{
		
	}
	
	private function digestAssignWorksByProducts()
	{
		$this->success = true;
	}
	
	/**
	 * 
	 */
	private function digestAssignWorksByTrades()
	{
		$trades = $this->tradeRepository->findAll();
		if(count($trades) > 0)
		{
			$assignValues['trades'] = $trades;
			foreach($trades as $trade)
			{
				$clients = $this->clientRepository->findByTrades($trade);
				{
					if(count($clients) > 0)
					{
						$clientsAssign[] = $clients;
						$this->success = true;
					}
				}

			}
		}
		
	}
	
	
	public function workImageAction()
	{
		$assignValues = [];
		$this->initArguments();
		$success = false;
		
		$assignValues['arguments'] = $this->arguments;
		
		if($this->request->hasArgument('imageId'))
		{
			$originalImage = $this->imageService->getImage($this->request->getArgument('imageId'), null, 1)->getOriginalFile();
			$imagePath = \N1coode\NjCollection\Utility\Image::getImagePath($originalImage);
			$file = $imagePath . $originalImage->getIdentifier();
			$success = file_exists(PATH_site .$file);
		}
		
		$this->view->assignMultiple($assignValues);
		return json_encode( 
            array(
                "success" => $success,
                "content" => $this->view->render()
			)
        );
	}
	
	public function workRandomAction()
	{
		$this->init();
		
		$success = 1;
		$error = 0;
		$message = "workRandomAction";
		
		$quantity = 5;
		if(intval($this->arguments['quantity']) > 0)
		{
			$quantity = intval($this->arguments['quantity']);
		}
		
		$works = $this->workRepository->findRandom($quantity);
		
		$images = [];
		
		foreach($works as $work)
		{
			$count = count($work->getImages());
			$get = 0;
			
			switch($count)
			{
				case 0:
					$get = -1;
					break;
				case 1:
					$get = 0;
					break;
				default:
					$get = mt_rand(0, $count - 1);
					break;
			}
			if($get > -1)
			{
				$x = 0;
				foreach($work->getImages() as $image)
				{
					if($get === $x)
					{
						$images[] = $image;
					}
					$x++;
				}
			}
		}
		$this->view->assign("images", $images);
		
		return json_encode( 
            array(
                "success"   => $success,
                "error"     => $error,
                "message"   => $message,
                "content"	=> $this->view->render() 
            )
        );
	}
	
	
} //end of class N1coode\NjPortfolio\Controller\AjaxController