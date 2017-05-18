<?php


namespace Statement;


class Statement
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

        /** @var \Statement\Operator $statement */
        foreach ($operations as $name => $statement) {

            if (!$statement->execute($persistOnly)) {
                $this->returnValue->addFailureError(get_class($statement->data()));
            } else {
                $this->returnValue->addSucceedMessage(get_class($statement->data()));
            }
            $this->returnValue->setUuid($statement->data()->getId());
        }

        return $this->returnValue;
    }

    public function operations()
    {
        return $this->operations;
    }
}