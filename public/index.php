<?php
/**
 * Info
 * User: fkus
 * Date: 26/12/2016
 * Time: 09:13
 */

require dirname(__DIR__) . '/vendor/autoload.php';

$inputHandler = new Http\Stream\InputHandler();

try {

    $routeHandler = new Http\Routing\RouteHandler(
        new Http\Routing\RouteSelector(dirname(getcwd()) . '/app/Data/RoutesIndex.php'),
        $inputHandler
    );

    $resolver = new Http\Resolve\Resolver(
        $routeHandler->handle(),
        $inputHandler
    );

    $dispatcher = new Http\Dispatch\Dispatcher(
        $resolver->handle(),
        $inputHandler
    );

    $outputHandler = new Http\Stream\OutputHandler(
        $dispatcher->handle(),
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

    // Redirect exception message to output
    if ($_SERVER['APPLICATION_ENV'] == 'development') {
        $outputHandler = new Http\Stream\OutputHandler(
            $exception->getMessage(),
            $inputHandler
        );
        $outputHandler->handle();
    }
}
