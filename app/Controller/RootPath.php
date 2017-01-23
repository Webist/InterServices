<?php

namespace App\Controller;


use Http\Stream\InputHandler;
use App\Config\RootPathHandler;

class RootPath implements \App\Config\RootPath
{
    private $inputHandler;
    private $handler;

    public function __construct(InputHandler $inputHandler, RootPathHandler $handler)
    {
        $this->inputHandler = $inputHandler;
        /** @var \App\Handler\RootPath $handler */
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function get()
    {
        ob_start();
        include '../web/home.php';
        return ob_get_clean();
    }

    public function post()
    {
        throw new \App\Exception\RootPath('This ' . __CLASS__ . '::' . __FUNCTION__ . ' is empty yet.');
    }

    public function getXhr()
    {
        throw new \App\Exception\RootPath('This ' . __CLASS__ . '::' . __FUNCTION__ . ' is empty yet.');
    }

    public function postXhr()
    {
        $handler = $this->handler;
        $globalHandler = $handler::$global;
            /** @var \Mail\Mailer $mailer */
        $mailer = $globalHandler->service($globalHandler::MAILER);
        $mailer->setData(
            $this->handler->sanitizeMailData(
                array_merge(['to' => self::EMAIL_TO], filter_input_array(INPUT_POST))
            )
        );

        try {
            if (!$mailer->send()) {
                throw new \Exception('Mail for delivery failed!');
            }

            $message = 'The mail was successfully accepted for delivery';
        } catch (\App\Exception\RootPath $exception) {
            $message = $exception->getMessage();
        }

        return json_encode([self::RESPONSE_MESSAGE_KEY => $message]);
    }
}
