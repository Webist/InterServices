<?php


namespace App\Spec;


interface Container
{
    function get($serviceObject, \Closure $callable);
}