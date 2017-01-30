<?php

namespace Http\Stream;


interface InputInterface
{
    /**
     * @example RewriteRule ^(.+)$ index.php [QSA,L]
     * /test?hello=123
     * /index.php/test?hello=123
     *
     * const applyRewriteURL = true;
     * const inputStream = INPUT_SERVER;
     * const inputStreamRequestUri = "REQUEST_URI";
     * const pathPrefix = "";
     * const indexPage = 'index.php';
     *
     * @example RewriteRule ^(.+)$ index.php?uri=$1 [QSA,L]
     * /test?hello=123
     * /index.php?uri=test&hello=123
     *
     * const applyRewriteURL = true;
     * const inputStream = INPUT_GET;
     * const inputStreamRequestUri = "uri";
     * const pathPrefix = "/";
     * const indexPage = 'index.php';
     */
    const applyRewriteURL = true;
    const inputStream = INPUT_SERVER;
    const inputStreamRequestUri = "REQUEST_URI";
    const pathPrefix = "";
    const indexPage = 'index.php';

    const inputStreamRequestMethod = "REQUEST_METHOD";
    const inputStreamQueryString = "QUERY_STRING";
}