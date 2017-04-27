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
     * @return string
     */
    public function mutate($operations)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $doctrine = new DoctrineORM();
        $entityManager = $doctrine->entityManager();

        try {

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

                if(!$entityManager->contains($newData)) {
                    throw new \Exception("Entity could not be managed `".get_class($newData)."`");
                }
            }
            $entityManager->flush();
            return 'ok';

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }
}
