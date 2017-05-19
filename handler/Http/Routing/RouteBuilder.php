<?php

namespace Http\Routing;

/**
 * A tool to build quickly a route, internally not used.
 *
 * @package Http\Routing
 */
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

    /**
     * @param bool $writeRouteFile Generates route file
     * @return MatchContext|mixed
     */
    public function buildRoute($writeRouteFile = false)
    {
        $this->matchContext->generateIndexKey();

        if ($writeRouteFile) {
            $fileName = dirname(dirname(dirname(__DIR__)))
                . '/app/Storage/Routes'
                . '/' . mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->matchContext->indexKey()) . '.php';

            $content = str_replace(
                ['Http\Routing\MatchContext::__set_state(', '));'],
                ['', ');'],
                '<?php return ' . var_export($this->matchContext, true) . ";\n"
            );

            file_put_contents($fileName, $content);

            return $fileName;
        }

        return $this->matchContext;
    }

}