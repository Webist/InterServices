<?php

namespace App\Controller;

use App\Exception\NotImplementedException;
use Exception;
use Http\Stream\InputHandler;

class RootPath implements \App\Spec\RootPath
{
    private $inputHandler;
    private $handler;

    public function __construct(InputHandler $inputHandler, \App\Handler\RootPath $handler)
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
        throw new NotImplementedException('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__);
    }

    public function getXhr()
    {
        throw new NotImplementedException('%s::%s needs to be implemented!', __CLASS__, __FUNCTION__);
    }

    public function postXhr()
    {
        /** @var \Mail\Mailer $mailer */
        $mailer = $this->handler->service(self::MAILER);
        $mailer->setData(
            $this->handler->sanitizeMailData(
                array_merge(['to' => self::EMAIL_TO], filter_input_array(INPUT_POST))
            )
        );

        try {
            if (!$mailer->send()) {
                throw new Exception('Mail for delivery failed!');
            }

            $message = 'The mail was successfully accepted for delivery';
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        return json_encode([self::RESPONSE_MESSAGE_KEY => $message]);
    }
}
