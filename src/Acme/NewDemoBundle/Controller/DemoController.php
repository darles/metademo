<?php

namespace Acme\NewDemoBundle\Controller;

use Acme\DemoBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Controller\DemoController as BaseDemoController;

class DemoController extends BaseDemoController
{
    /**
     * @Route("/pagination", name="_demo_pagination_new")
     * @Template()
     */
    public function paginationAction(Request $request)
    {
        $page = (int)$request->query->get('page', 1);
        $service = $this->getCategoryService();
        $entities = $service->getPaginatedResults($page, 5);

        //Override neveikia
//        return $this->render('@AcmeDemo/Demo/pagination.html.twig', ['entities' => $entities]);
        //Override veikia
        return $this->render('AcmeDemoBundle:Demo:pagination.html.twig', ['entities' => $entities]);
        //Override veikia
//        return ['entities' => $entities];
    }

    /**
     * @return \Acme\DemoBundle\Service\CategoryService
     */
    private function getCategoryService()
    {
        return $this->container->get('acme_demo.service.category');
    }

}
