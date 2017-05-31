<?php


namespace Statement;


class Operations
{
    private $operations;

    public function __construct(array $operations, \Statement\ReturnValue $returnValue)
    {
        $this->operations = $operations;
        $this->returnValue = $returnValue;
    }

    /**
     * @return ReturnValue
     */
    public function execute()
    {
        $operations = $this->operations();

        /** @var \Statement\Operator $operation */
        foreach ($operations as $operation) {

            if (!$operation->execute()) {
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