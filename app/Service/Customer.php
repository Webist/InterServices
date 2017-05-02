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

    public function get($operations)
    {
        return call_user_func($operations);
    }

    public function dispatch($operations)
    {
        $operations = call_user_func($operations);
        $returnValue = new CustomerReturnValue();

        /** @var \App\Spec\Command $operation */
        foreach ($operations as $operation) {
            $className = get_class($operation);

            // when multiple persist, to flush later.
            // $operation->persist();
            // $toFlush[] = $operation;

            if (!$operation->execute()) {
                $returnValue->addFailureError($className);
            } else {
                $returnValue->addSucceedMessage($className);
            }
        }

        return $returnValue;
    }
}
