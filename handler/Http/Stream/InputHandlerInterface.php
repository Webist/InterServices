<?php

namespace Http\Stream;


interface InputHandlerInterface
{
    function requestUrlPath();
    function requestMethod();
    function isAjax();
    function parameters();
}