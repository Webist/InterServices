<?php


namespace App\Contract\Behave;


/**
 * Interface InterActor
 *
 * @package App\Contract\Behave
 */
interface InterActor
{
    /**
     * InterActor constructor.
     * @param \App\Service\App $app
     */
    function __construct(\App\Service\App $app);
}