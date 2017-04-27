<?php

namespace App\Service;

class Customer
{
    /**
     * Operations holding callable
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function invoke()
    {
        return call_user_func($this->callback);
    }

    /**
     * Persists operations to data store
     * @param $operations array
     * @return array
     */
    public function mutate($operations)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $doctrine = new DoctrineORM();
        $entityManager = $doctrine->entityManager();

        $results = [];
        foreach($operations as $op){

            // Entity object
            $newData = $op->data();

            $repo = $entityManager->getRepository(get_class($newData));
            $data = $repo->find($op->data()->getId());

            if($data){
                $entityManager->merge($newData);
            } else {
                $entityManager->persist($newData);
            }

            $results[] = $entityManager->contains($newData);
        }
        $entityManager->flush();
        return $results;
    }
}
