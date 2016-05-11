<?php
namespace N1coode\NjPortfolio\Domain\Repository;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class WorkRepository extends \N1coode\NjPortfolio\Domain\Repository\AbstractRepository
{
	
	/**
	 * Finds all portfolios by the specified category
	 *
	 * @param \N1coode\NjPortfolio\Domain\Model\Category $category The category the portfolio must refer to.
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface The works
	 */
	public function findAllByCategory(\N1coode\NjPortfolio\Domain\Model\Category $category)
	{
		$query = $this->createQuery();
		return $query
		->matching(
			$query->contains('categories', $category)
		)
		->execute();
	}
	
	public function findRandom($limit = 5) 
	{
		$query = $this->createQuery();
		$worksArray = $query->execute()->toArray();
		shuffle($worksArray);
	
		if(intval($limit)>0)
		{
			$works = array_slice($worksArray,0,intval($limit));
		}
		else
		{
			$works = $worksArray;
		}
		return $works;
	}

	
} //end of class Tx_NjPortfolio_Domain_Repository_WorkRepository
?>