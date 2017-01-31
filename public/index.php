<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$inputHandler = new Http\Stream\InputHandler();

try {

    $routeHandler = new Http\Routing\RouteHandler(
        new Http\Routing\RouteSelector(dirname(getcwd()) . '/app/Data/RoutesIndex.php'),
        $inputHandler
    );

    $resolver = new Http\Resolve\Resolver(
        $routeHandler,
        $inputHandler
    );

    $dispatcher = new Http\Dispatch\Dispatcher(
        $resolver,
        $inputHandler
    );

    $outputHandler = new Http\Stream\OutputHandler(
        $dispatcher,
        $inputHandler
    );

    $outputHandler->handle();
} catch (Http\Routing\NotFoundException $exception) {

    include '../web/404.php';
} catch (Exception $exception) {

    $errorHandler = new \Http\Stream\ErrorHandler(
        $exception,
        $inputHandler
    );
    $errorHandler->handle();
}
