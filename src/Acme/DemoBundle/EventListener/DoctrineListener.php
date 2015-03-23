<?php

namespace Acme\DemoBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;

/**
 * Class DoctrineListener
 */
class DoctrineListener implements EventSubscriber {

    /**
     * get subscribed events
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preFlush'];
    }

    public function prePersist(LifecycleEventArgs $event)
    {
//        $event->getEntity()->setTitle('Pavadinimas iš listener');
    }

    /**
     * @param PreFlushEventArgs $event
     */
    public function preFlush(PreFlushEventArgs $event)
    {
//        $em = $event->getEntityManager();
//        $uow = $em->getUnitOfWork();
//        $uow->computeChangeSets();
//
//        //Nauji įrašai
//        dump($uow->getScheduledEntityUpdates());
//        //Atnaujinami įrašai
//        dump($uow->getScheduledEntityInsertions());
//
//        foreach(array_merge([$uow->getScheduledEntityUpdates(), $uow->getScheduledEntityInsertions()]) as $entities) {
//            foreach($entities as $entity) {
//                dump($uow->getEntityChangeSet($entity));
//                dump($uow->getOriginalEntityData($entity));
//            }
//        }
    }

}

