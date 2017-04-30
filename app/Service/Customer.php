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
     * @param $operations
     * @return CustomerReturnValue
     */
    public function dispatch($operations)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $doctrine = new ORM();
        $entityManager = $doctrine->entityManager();

        $customerReturnValue = new CustomerReturnValue();

        foreach ($operations as $op) {

            // Entity object
            $newData = $op->data();

            $className = get_class($newData);

            $repo = $entityManager->getRepository($className);
            $data = $repo->find($op->data()->getId());

            if ($data) {
                $entityManager->merge($newData);
            } else {
                $entityManager->persist($newData);
            }

            if (!$entityManager->contains($newData)) {
                $customerReturnValue->addFailureError($className);
            }
            $customerReturnValue->addSucceedMessage($className);
        }
        $entityManager->flush();

        return $customerReturnValue;
    }
}
