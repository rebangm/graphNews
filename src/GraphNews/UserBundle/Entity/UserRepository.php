<?php

namespace GraphNews\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * 
     * @return type
     */
    public function getTotalCount()
    {
        $queryBuilder = $this->_em->createQueryBuilder()
            ->select('count(u.id)')
            ->from($this->_entityName, 'u');

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

}
