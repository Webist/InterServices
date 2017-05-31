<?php


namespace Statement;


class Selector
{
    private $predicates;

    public function setPredicates(array $predicates)
    {
        $this->predicates = $predicates;
    }

    public function getPredicates()
    {
        return $this->predicates;
    }

    /**
     * new OrderBy ...
     */
    public function setOrderings(array $orderings)
    {

    }

    public function setFields(array $field)
    {

    }

    /**
     * @param $paging \Paging
     */
    public function setPaging($paging)
    {

    }
}