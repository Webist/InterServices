<?php

namespace Http\Routing;


class RouteBuilder
{
    private $matchContext;

    public function __construct(string $requestMethod, string $path, string $destination, string $deliveryModel = 'MOM')
    {
        $this->matchContext = new MatchContext();

        $this->matchContext->setMatchContext($requestMethod, $path);
        $this->matchContext->setDeliveryModel($deliveryModel);
        $this->matchContext->setDestination($destination);

    }

    public function setXRequestedWith(bool $bool)
    {
        $this->matchContext->setXRequestedWith($bool);
    }

    public function buildRoute()
    {   $this->matchContext->generateIndexKey();
        return $this->matchContext;
    }

}