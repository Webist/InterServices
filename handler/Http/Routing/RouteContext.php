<?php
/**
 * Info
 * Created: 11/01/2017 18:02
 * User: fkus
 */

namespace Http\Routing;


class RouteContext extends RouteAbstract
{
    public function __construct(string $requestMethod, string $path, string $destination)
    {
        parent::__construct();

        $this->setMatchContext($requestMethod, $path);
        $this->setDestination($destination);
    }

    public function setXRequestedWith(bool $bool)
    {
        $this->matchContext['http_']['HTTP_X_REQUESTED_WITH'] = $bool;
    }

    public function buildRoute()
    {   $this->generateIndexKey();
        return $this;
    }

}