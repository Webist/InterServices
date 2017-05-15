<?php

namespace App\InterActor;


class RootPath implements \App\Contract\Spec\RootPath
{
    /**
     * Holds route, input information and access to generic handler
     * @var \App\Storage\Meta
     */
    private $meta;

    /**
     * @var \App\Service\Container
     */
    private $container;

    /**
     * RootPath constructor.
     * @param \App\Storage\Meta $meta
     * @param \App\Service\Container $container
     */
    public function __construct(\App\Storage\Meta $meta, \App\Service\Container $container)
    {
        $this->meta = $meta;
        $this->container = $container;
    }

    /**
     * @return \App\Storage\Meta
     */
    public function meta()
    {
        return $this->meta;
    }

    /**
     * @return array
     */
    public function contentArrayMap()
    {
        return [];
    }

    /**
     * email array map, maintains array map, executes operations
     * @param array $arrayMap
     * @return \Mail\ReturnValue
     */
    public function emailArrayMap(array $arrayMap): \Mail\ReturnValue
    {
        $arrayMap['email_to'] = self::EMAIL_TO;

        /** @var \App\Service\Mailer $mailerService */
        $mailerService = $this->container->get(self::MAILER);
        $mailerService->maintainArrayMap($arrayMap);
        $mailerService->setArrayMapOperations();
        return $mailerService->execute();
    }

}
