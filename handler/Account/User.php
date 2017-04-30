<?php

namespace Account;


class User
{
    /**
     * @var UserData
     */
    private $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(UserData $userData, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->data = $userData;
        $this->entityManager = $entityManager;
    }

    public function data()
    {
        return $this->data;
    }

    public function handle()
    {
        $entityManager = $this->entityManager;

        $repo = $entityManager->getRepository(UserData::class);
        $data = $repo->find($this->data->getId());

        if($data){
            $entityManager->merge($this->data);
        } else {
            $entityManager->persist($this->data);
        }

        $entityManager->flush();
        return $entityManager->contains($this->data);
    }
}