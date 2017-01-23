<?php
/**
 * Info
 * Created: 09/01/2017 20:36
 * User: fkus
 */

namespace Http\Stream;


class OutputHandler
{
    private $result;
    private $inputHandler;

    public function __construct($result, InputHandler $inputHandler)
    {
        $this->result = $result;
        $this->inputHandler = $inputHandler;
    }

    public function handle(){

        if($this->inputHandler->isAjax()){
            header('Content-Type: application/json');
        }

        echo $this->result;
    }
}