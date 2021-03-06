<?php

namespace Stfalcon\Bundle\PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Stfalcon\Bundle\PortfolioBundle\Entity\Category;

/**
 * Project Repository
 */
class ProjectRepository extends EntityRepository
{

    /**
     * Get query for select projects by category
     *
     * @param Category $category
     *
     * @return Query
     */
    public function getQueryForSelectProjectsByCategory(Category $category)
    {
        return $this->createQueryBuilder('p')
                ->select('p')
                ->join('p.categories', 'c')
                ->where('c.id = ?1')
                ->orderBy('p.ordernum', 'ASC')
                ->setParameter(1, $category->getId())
                ->getQuery();
    }

    /**
     * Get all projects from this category
     *
     * @param Category $category A category object
     *
     * @return array
     */
    public function getProjectsByCategory(Category $category)
    {
        return $this->getQueryForSelectProjectsByCategory($category)
                ->getResult();
    }

    /**
     * @return array
     */
    public function findAllProjectsOrderingByDate()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}