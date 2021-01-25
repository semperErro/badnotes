<?php


namespace controller;

use dao\sql\SqlDaoFactory;
use dao\sql\SqlUserDao;
use model\User;

/**
 * Class UserController
 * @package controller
 *
 * Responsibilities: Create, Replace, Update and Delete Users
 */
class UserController
{
    const SUCCESS = 0;
    const INVALID_EMAIL = 1;
    const INVALID_PASSWORD = 2;
    const INVALID_PASSWORD_REPEAT = 4;
    const EMAIL_IN_USE = 8;
    const NAME_IN_USE = 16;
    private const MIN_PASSWORD_LENGTH = 6;

    public function createUser(string $name, string $email, string $password, string $passwordRepeated): int
    {
        $resultCode = self::SUCCESS;

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email == false) {
            $resultCode |= self::INVALID_EMAIL;
        }
        if ($password != $passwordRepeated) {
            $resultCode |= self::INVALID_PASSWORD_REPEAT;
        }
        if (strlen($password) < self::MIN_PASSWORD_LENGTH) {
            $resultCode |= self::INVALID_PASSWORD;
        }
        if ($resultCode != self::SUCCESS) {
            return $resultCode;
        }

        // Check if user exists
        /*        $entityManager = \getEntityManager();
                /** @var IUserDao $userRepo
                $userRepo = $entityManager->getRepository(UserRepository::class);
                $user = $userRepo->findByName($name); // TODO*/

        $daoFactory = new SqlDaoFactory();
        /** @var SqlUserDao $userDao */
        $userDao = $daoFactory->createUserDao('users');

        $user = $userDao->findByEmail($email);
        if ($user == null) {
            // Create user since it does not exist
            $user = new User($name, $email, password_hash($password, PASSWORD_DEFAULT), []);
            $userDao->createUser($user);
        } else {
            $resultCode |= self::EMAIL_IN_USE;
        }

        return $resultCode;
    }
}