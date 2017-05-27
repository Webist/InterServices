<?php


namespace App\Contract\Behave;


interface InterActor
{
    function __construct(\App\Storage\Meta $meta, \App\InterActor\App $app);
}