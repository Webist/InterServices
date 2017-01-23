<?php
/**
 * Info.
 * User: fkus
 * Date: 26/12/2016
 * Time: 10:05
 */

namespace Http\Stream;


interface InputHandlerInterface
{
    function requestUrlPath();
    function requestMethod();
    function isAjax();
    function parameters();
}