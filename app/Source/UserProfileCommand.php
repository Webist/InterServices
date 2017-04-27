<?php


namespace App\Source;


use App\Spec\ORM;

class UserProfileCommand implements ORM
{
    private $container;
    public function __construct(\Service\Container $container)
    {
        $this->container = $container;
    }

    /**
     * Creates new userProfile, User when there is no userProfile with the same email address
     * @param array $postData
     * @param string $uuid
     * @return bool
     */
    public function postXhrOperations(array $postData, string $uuid)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        $repo = $entityManager->getRepository(\Account\UserProfileData::class);
        /** @var \Account\UserProfileData $userProfileData */
        $userProfileData = $repo->findOneBy(['email' => $postData['email']]);

        $operations = [];
        // no-user matched, then create new user
        if (!$userProfileData) {

            $userProfileData = new \Account\UserProfileData($uuid);
            $userProfileData->setEmail($postData['email']);
            $userProfileData->setPhone($postData['phone']);
            $userProfileData->setFullName('');
            $userProfileData->setGender(0);
            $userProfileData->setAddress('');
            $userProfileData->setCity('');
            $userProfileData->setCountry('');
            $userProfileData->setRemarks('');

            $operations[] = new \Account\UserProfile($userProfileData, $entityManager);

            $userData = new \Account\UserData($uuid);
            $userData->setName($postData['name']);
            $userData->setPasswd(1);

            $operations[] = new \Account\User($userData, $entityManager);
        }

        return $operations;
    }
}