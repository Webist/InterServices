<?php


namespace Journal;


class EntityEvent
{
    /**
     * After a new insert
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     * @return bool
     */
    public function postPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args)
    {
        if(strlen($args->getObject()->getId()) === 36 ) {

            $em = $args->getEntityManager();
            $object = $args->getObject();

            $data = new EntityEventData();
            $data->setUuid($object->getId());
            $data->setName(get_class($object));
            $data->setObject($object);
            $data->setSequence(1);
            $data->setCreatedAt(new \DateTime('now'));
            $data->setVersion(1);
            $data->setChangeSet($em->getUnitOfWork()->getEntityChangeSet($object));

            $em->persist($data);
            $em->flush();
            return $em->contains($data);
        }
        return false;
    }

    /**
     * After anything was changed
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     * @return bool
     */
    public function postUpdate(\Doctrine\ORM\Event\LifecycleEventArgs $args)
    {
        if(strlen($args->getObject()->getId()) === 36 ) {

            $em = $args->getEntityManager();
            $object = $args->getObject();

            // var_dump($em->getUnitOfWork()->getEntityChangeSet($object));

            $data = new EntityEventData();
            $data->setUuid($object->getId());
            $data->setName(get_class($object));
            $data->setObject($object);
            $data->setSequence(2);
            $data->setCreatedAt(new \DateTime('now'));
            $data->setVersion(1);
            $data->setChangeSet($em->getUnitOfWork()->getEntityChangeSet($object));

            $em->persist($data);
            $em->flush();
            return $em->contains($data);
        }
        return false;
    }
}