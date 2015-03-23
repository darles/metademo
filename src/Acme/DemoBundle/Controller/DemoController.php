<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{
    /**
     * @Route("/detach", name="_demo_detach")
     * @Template()
     */
    public function detachAction()
    {
        $em = $this->getEntityManager();
        $repo = $em->getRepository('AcmeDemoBundle:Category');
        $item = $repo->find(1);

        $em->detach($item);
        $item->setTitle('Pavadinimas po detach');
        $em->persist($item);
        $em->flush();

        $all = $repo->findAll();

        dump($all);
        exit();
    }

    /**
     * @Route("/clear", name="_demo_clear")
     * @Template()
     */
    public function clearAction()
    {
        $em = $this->getEntityManager();
        $repo = $em->getRepository('AcmeDemoBundle:Category');
        $item = $repo->find(1);

        $em->clear();
        $item->setTitle('Pavadinimas po clear');
        $em->persist($item);
        $em->flush();

        $all = $repo->findAll();

        dump($all);
        exit();
    }

    /**
     * @Route("/merge", name="_demo_merge")
     * @Template()
     */
    public function mergeAction()
    {
        $em = $this->getEntityManager();
        $repo = $em->getRepository('AcmeDemoBundle:Category');
        $item = $repo->find(1);

        $serializedItem = serialize($item);
        $unserializedItem = unserialize($serializedItem);

        $unserializedItem->setTitle('Pavadinimas po serialize');
        $em->merge($unserializedItem);
        $em->flush();

        $all = $repo->findAll();

        dump($all);
        exit();
    }

    /**
     * @Route("/event1", name="_demo_event1")
     * @Template()
     */
    public function eventAction()
    {
        $em = $this->getEntityManager();
        $item = new Post();
        dump($item);

        $item->setCategory($em->getRepository('AcmeDemoBundle:Category')->find(1));
        $item->setContent('test');
        $em->persist($item);
        //PrePersist
        dump($item);

        $em->flush();
        //PostPersist
        dump($item);

        $item = $em->getRepository('AcmeDemoBundle:Post')->find(1);
        //PostLoad
        dump($item);

        $item->setTitle('testas');
        $em->persist($item);
        $em->flush();
        //PreUpdate
        dump($item);

        exit();
    }

    /**
     * @Route("/event2", name="_demo_event2")
     * @Template()
     */
    public function event2Action()
    {
        $em = $this->getEntityManager();
        $item = $em->getRepository('AcmeDemoBundle:Post')->find(1);
        $em->persist($item);
        $em->flush();
        exit();
    }

    /**
     * @Route("/pagination", name="_demo_pagination")
     * @Template()
     */
    public function paginationAction(Request $request)
    {
        $page = (int)$request->query->get('page', 1);
        $service = $this->getCategoryService();
        $entities = $service->getPaginatedResults($page, 5);

        return $this->render('@AcmeDemo/Demo/pagination.html.twig', ['entities' => $entities]);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * @return \Acme\DemoBundle\Service\CategoryService
     */
    private function getCategoryService()
    {
        return $this->container->get('acme_demo.service.category');
    }

}
