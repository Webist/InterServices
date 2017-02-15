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
class BillingSchedule implements BillingScheduleSpec
{
    private $id;
    private $schedule;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function handle()
    {
        // .. save into tasks-schedule or scheduler.
    }
}