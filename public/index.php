<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$inputHandler = new Http\Stream\InputHandler();

try {

    $routeHandler = new Http\Routing\RouteHandler(
        $inputHandler,
        new Http\Routing\MatchContext()
    );

    $resolver = new Http\Resolve\Resolver(
        $routeHandler,
        new \App\InterActor\App()
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

    include dirname(__DIR__) . '/web/404.php';
} catch (Throwable $throwable) {

    $errorHandler = new Http\Stream\ErrorHandler(
        $throwable,
        $inputHandler
    );
    $errorHandler->handle();
}
