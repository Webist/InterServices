<?php
/**
 * Info
 * Created: 15/02/2017 00:23
 *
 */

namespace Payment;


class CreditCard
{
    private $input;
    private $autopay = false;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * @return bool
     */
    public function isAutopay(): bool
    {
        return $this->autopay;
    }

    /**
     * @param bool $autopay
     */
    public function setAutopay(bool $autopay)
    {
        $this->autopay = $autopay;
    }

    public function handle()
    {
        // .. save to persistence
    }
}