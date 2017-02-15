<?php
/**
 * Info
 * Created: 15/02/2017 00:54
 *
 */

namespace Notify;

/**
 * @example Email me monthly billing.
 *
 * Class Billing
 * @package Notify
 */
class Billing
{
    private $id;
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function handle()
    {
        // .. save into tasks-schedule or scheduler.
    }
}