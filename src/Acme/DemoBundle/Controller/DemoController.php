<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Post;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Form\PostType;
use Acme\DemoBundle\Form\UserType;
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
     * @Route("/form/user/{id}", name="_demo_form_user", defaults={"id" = 0})
     * @Template()
     */
    public function formUserAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);
        if ($entity === null) {
            $entity = new User();
        }
        $form = $this->createForm(new UserType(), $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            dump($entity);
            exit();
        }
        return array(
            'form' => $form->createView(),
            'id' => $entity->getId()
        );
    }

    /**
     * @Route("/form/post/{id}", name="_demo_form_post", defaults={"id" = 0})
     * @Template()
     */
    public function formPostAction(Request $request, $id)
    {
        $em = $this->getEntityManager();
        $entity = $em->getRepository('AcmeDemoBundle:Post')->find($id);
        if ($entity === null) {
            $entity = new Post();
        }
        $form = $this->createForm(new PostType(), $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            exit();
        }
        return array(
            'form' => $form->createView(),
            'id' => $entity->getId()
        );
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
