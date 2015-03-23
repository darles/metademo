<?php

namespace Acme\DemoBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\Paginator;

/**
 * Class CategoryService
 *
 * @package Acme\DemoBundle\Service
 */
class CategoryService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repo;

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @var string
     */
    protected $class;

    /**
     * @param EntityManager $em
     * @param Paginator $paginator
     */
    public function __construct(
        EntityManager $em,
        Paginator $paginator
    ) {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    /**
     * @param $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @param $repo
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $page
     * @return mixed
     */
    public function getPaginatedResults($page, $itemsPerPage)
    {
        $query = $this->repo->searchQuery();
        return $this->paginator->paginate($query, $page, $itemsPerPage);
    }

}