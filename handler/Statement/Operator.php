<?php


namespace Statement;


class Operator
{
    private $operations;

    public function __construct(array $operations, \Statement\ReturnValue $returnValue)
    {
        $this->operations = $operations;
        $this->returnValue = $returnValue;
    }

    /**
     * @param bool $persistOnly
     * @return \Statement\ReturnValue
     */
    public function execute($persistOnly = false)
    {
        $operations = $this->operations();

        /** @var \Statement\Operation $operation */
        foreach ($operations as $operation) {

            if (!$operation->execute($persistOnly)) {
                $this->returnValue->addFailureError(get_class($operation->data()));
            } else {
                $this->returnValue->addSucceedMessage(get_class($operation->data()));
            }
            $this->returnValue->setUuid($operation->data()->getId());
        }

        return $this->returnValue;
    }

    public function operations()
    {
        return $this->operations;
    }
}