<?php

namespace Http\Stream;


class InputHandler implements InputInterface, InputHandlerInterface
{
    /**
     * Gets request URL path
     * @return string
     */
    public function requestUrlPath() : string
    {
        $urlComponents = parse_url(self::pathPrefix . filter_input(self::inputStream,
                self::inputStreamRequestUri, FILTER_SANITIZE_STRING));

        if(self::applyRewriteURL){

            if(!$urlComponents){
                return '';
            }

            // URL access equals the index page path
            if($this->isBasePath($urlComponents['path'])){
                return '/';
            }

            // URL access matches the default host (e.g. localhost), instead of vhost, document_root differs.
            if(($scriptName = dirname(filter_input(INPUT_SERVER,'SCRIPT_NAME'))) != '/' ){
                $urlComponents['path'] = str_replace($scriptName,'', $urlComponents['path']);

                if($this->isBasePath($urlComponents['path'])){
                    return '/';
                }
            }

            return rtrim(str_replace('/' . self::indexPage, '', $urlComponents['path']), '/');
        }

        return $urlComponents['path'];
    }

    /**
     * Detects if the given string equals to base path
     * @param string $path
     * @return string
     */
    private function isBasePath(string $path) : string
    {
        return ($path === '/' || rtrim($path, '/') === '/' . self::indexPage);
    }

    /**
     * Gets request method
     * @return string|null
     */
    public function requestMethod()
    {
        return filter_input(INPUT_SERVER, self::inputStreamRequestMethod);
    }

    /**
     * Detects if the input request is ajax
     * @return bool
     */
    public function isAjax()
    {
        return !is_null(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH'));
    }

    /**
     * Gets input parameters
     * @return array
     */
    public function parameters()
    {
        $params = [];

        if(PHP_SAPI === "cli" && array_key_exists('argv', $_SERVER)) {
            // a simple CLI arguments collector
            parse_str(implode('&', array_slice($_SERVER['argv'], 1)), $params);
        } else {

            switch($this->requestMethod()) {
                case "GET":
                    $params['GET'] = filter_input_array(INPUT_GET);
                case "HEAD":
                    $params['HEAD'] = filter_input_array(INPUT_GET);
                case "POST":
                    $params['POST'] = filter_input_array(INPUT_POST);
                    $params['GET'] = filter_input_array(INPUT_GET);
                case "PUT":
                    $put = [];
                    parse_str(file_get_contents('php://input'), $put);
                    $params['PUT'] = $put;
            }
        }
        return $params;
    }

    public function parameter($name)
    {
        $methods = $this->parameters();
        foreach($methods as $parameters){
            if(isset($parameters[$name])){
                return $parameters[$name];
            }
        }
    }
}
