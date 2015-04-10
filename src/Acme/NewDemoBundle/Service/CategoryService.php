<?php

namespace Acme\NewDemoBundle\Service;

use Acme\DemoBundle\Service\CategoryService as BaseService;

/**
 * Class CategoryService
 *
 * @package Acme\DemoBundle\Service
 */
class CategoryService extends BaseService
{
    /**
     * @param $page
     * @return mixed
     */
    public function getPaginatedResults($page, $itemsPerPage)
    {
        return parent::getPaginatedResults($page, $itemsPerPage);
    }

}