<?php
namespace N1coode\NjPortfolio\Domain\Model;

/**
 * A work
 * @author n1coode
 * @package nj_portfolio
 */
class Work extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * The categories of this work
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Category>
	 * @cascade remove
	 */
	protected $categories;
	
	
	/**
	 * @var \N1coode\NjPortfolio\Domain\Model\Client
	 * @cascade remove
	 */
	protected $client;
	
	
	/**
	 * @var DateTime
	 */
	protected $date;
	
	
	/**
	 * @var string
	 */
	protected $description = '';
	
	
	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images;
	
	
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $previewImage;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Product>
	 * @cascade remove
	 */
	protected $products;
	
	
	/**
	 * @var int 
	 */
	protected $showDescription;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $title;
	
	
	/* ***************************************************** */
	
	/**
	 * Constructs a new work
	 * @return AbstractObject
	 */
	public function __construct() 
	{
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}
	
	/* ***************************************************** */
	
	
	
	/**
	 * Getter for the description
	 *
	 * @return string
	 */
	public function getCdColorFront()
	{
		return $this->cdColorFront;
	}
	
	
	/**
	 * Setter for the date
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setDate(DateTime $date)
	{
		$this->date = $date;
	}
	
	/**
	 * Getter for the date
	 *
	 * @return DateTime
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	
	/**
	 * Returns all categories of this work
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Category>
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	
	/**
	 * Returns the images
	 * 
	 * @return array $images
	 */
	public function getImages() 
	{
		$return = [];
		if(!empty($this->images))
		{
			foreach($this->images as $image)
			{
				$return[] = $image;
			}
		}
		
		return $return;
	}
	 
	 /**
	  * Sets the images
	  * 
	  * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	  * @return void
	  */
	public function setImages($images) 
	{
		$this->images = $images;
	}
		
	 
	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	/**
	 * Getter for the description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	
	/**
	 * Returns the client of this work
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getClient()
	{
		return $this->client;
	}
	
	
	/**
	 * Returns all products of this work
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjPortfolio\Domain\Model\Product>
	 */
	public function getProducts()
	{
		return $this->products;
	}
	
	
	/**
	 * @param int $showDescription
	 * @return void
	 */
	public function setShowDescription($showDescription)
	{
		$this->showDescription = $showDescription;
	}
	
	/**
	 * @return int
	 */
	public function getShowDescription()
	{
		return $this->showDescription;
	}
	
	
	/**
	 * Setter for the preview image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage
	 * @return void
	 */
	public function setPreviewImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage)
	{
		$this->previewImage = $previewImage;
	}
	
	/**
	 * Getter for the preview image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getPreviewImage()
	{
		return $this->previewImage;
	}
	
	
	
	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Getter for the title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	
} //end of class \N1coode\NjPortfolio\Domain\Model\Work