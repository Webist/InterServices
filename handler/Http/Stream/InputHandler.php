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
     * Detects if the input request is ajax
     * @return bool
     */
    public function isAjax()
    {
        return !is_null(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH'));
    }

    /**
     * REQUEST_METHOD: POST
     * @return array|mixed
     */
    public function postArrayMap()
    {
        return filter_input_array(INPUT_POST) ?? [];
    }

    /**
     * REQUEST_METHOD: GET
     * @return array|mixed
     */
    public function getArrayMap()
    {
        return filter_input_array(INPUT_GET) ?? [];
    }

    /**
     * REQUEST_METHOD: PUT
     * @return array
     */
    public function putArrayMap()
    {
        $put = [];
        parse_str(file_get_contents('php://input'), $put);
        return $put;
    }

    /**
     * REQUEST_METHOD: OPTIONS
     *
     */
    public function optionsArrayMap()
    {

    }

    /**
     * request to receive headers only
     * REQUEST_METHOD: HEAD
     */
    public function headArrayMap()
    {

    }

    /**
     * REQUEST_METHOD: TRACE
     */
    public function traceArrayMap()
    {

    }

    /**
     * REQUEST_METHOD: DELETE
     */
    public function deleteArrayMap()
    {

    }

    /**
     *
     * REQUEST_METHOD: CONNECT
     */
    public function connectArrayMap()
    {

    }

    /**
     * a simple CLI arguments collector
     * @return array
     */
    public function cliArgumentsArrayMap()
    {
        $params = [];
        if(PHP_SAPI === "cli" && array_key_exists('argv', $_SERVER)) {
            parse_str(implode('&', array_slice($_SERVER['argv'], 1)), $params);
        }
        return $params;
    }

    /**
     * Input parameters of the current request method.
     * @notice Use appropriate method in this @class for other values
     * @return array
     */
    public function parameters()
    {
        switch ($this->requestMethod()) {
            case "POST":
                return $this->postArrayMap();
                break;
            case "GET" :
                return $this->getArrayMap();
                break;
        }
    }

    /**
     * Gets request method
     * @return string|null
     */
    public function requestMethod()
    {
        return filter_input(INPUT_SERVER, self::inputStreamRequestMethod);
    }
}
