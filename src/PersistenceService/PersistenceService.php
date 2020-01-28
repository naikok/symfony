<?php
namespace App\PersistenceService;

use App\PersistenceService\IPersistenceService;
use Doctrine\ORM\EntityManagerInterface;

abstract class PersistenceService
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get doctrine entityManager
     * @return EntityManagerInterface
     *
     */

    protected function getEntityManager() : EntityManagerInterface
    {
        return $this->entityManager;
    }
}


