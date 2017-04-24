<?php

namespace Http\Dispatch;

use Http\Resolve\ResolverInterface;

class Dispatcher implements ResolverInterface, DispatcherInterface
{
    private $resolver;
    private $inputHandler;

    public function __construct(\Http\Resolve\Resolver $resolver, \Http\Stream\InputHandler $inputHandler)
    {
        $this->resolver = $resolver;
        $this->inputHandler = $inputHandler;
    }

    public function handle()
    {
        $route = $this->resolver->handle();

        switch($route[self::DELIVERY_NAME]) {
            case self::DELIVERY_MODEL_SIMPLE :
                $delivery = new \Delivery\Simple;
                return $delivery($route, $route[self::CLASS_FIELD_NAME]);
            case self::DELIVERY_MODEL_MVC :
                $delivery = new \Delivery\MVC;
                return $delivery(
                    $route[self::CLASS_FIELD_NAME],
                    $route[self::CLASS_ACTION_FIELD_NAME],
                    $this->inputHandler->parameters());
            case self::DELIVERY_MODEL_MOM :
                $delivery = new \Delivery\MOM;
                return $delivery(
                    $route[self::CLASS_FIELD_NAME],
                    $route[self::CLASS_HANDLER_NAME],
                    $route[self::CLASS_ACTION_FIELD_NAME],
                    $route,
                    $this->inputHandler
                );

            default :
                throw new \RuntimeException("Delivery parameter `{$route[self::DELIVERY_NAME]}` is not implemented, 
                it should be one of [simple, MVC, MOM]");
        }
    }
}