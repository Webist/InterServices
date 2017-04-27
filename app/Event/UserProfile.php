<?php


namespace App\Event;


use App\Spec\ORM;

class UserProfile implements ORM
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
        $doctrine = $this->container->get(self::DOCTRINE, function(){});
        $entityManager = $doctrine->entityManager();

        $repo = $entityManager->getRepository(\Account\UserProfileData::class);
        /** @var \Account\UserProfileData $userProfileData */
        $userProfileData = $repo->findOneBy(['email' => $postData['email']]);

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

            $this->createUserProfile($userProfileData, $entityManager);

            $userData = new \Account\UserData($uuid);
            $userData->setName($postData['name']);
            $userData->setPasswd(1);

            $this->createUser($userData, $entityManager);
        }
    }

    public function createUserProfile(\Account\UserProfileData $userProfileData, $entityManager)
    {
        $userProfile = new \Account\UserProfile($userProfileData, $entityManager);
        return $userProfile->handle();
    }

    public function createUser(\Account\UserData $userData, $entityManager)
    {
        $user = new \Account\User($userData, $entityManager);
        return $user->handle();
    }
}