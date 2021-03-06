<?php
namespace N1coode\NjPortfolio\Domain\Repository;

/**
 * @author n1coode
 * @package nj_portfolio
 */
class TradeRepository extends \N1coode\NjPortfolio\Domain\Repository\AbstractRepository
{
	protected $defaultOrderings = array(
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
} //end of class