<?php


namespace controller;


class UserController
{
    const SUCCESS = 0;
    const INVALID_EMAIL = 1;
    const INVALID_PASSWORD = 2;
    const INVALID_PASSWORD_REPEAT = 4;
    const EMAIL_IN_USE = 8;
    private const MIN_PASSWORD_LENGTH = 6;

    public function createUser(string $name, string $email, string $password, string $passwordRepeated): int
    {
        $resultCode = self::SUCCESS;

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email == false) {
            $resultCode |= self::INVALID_EMAIL;
        }
        // TODO: Check if E-Mail is in use

        if ($password != $passwordRepeated) {
            $resultCode |= self::INVALID_PASSWORD_REPEAT;
        }

        if (strlen($password) < self::MIN_PASSWORD_LENGTH) {
            $resultCode |= self::INVALID_PASSWORD;
        }

        if ($resultCode == self::SUCCESS) {
            // TODO: entityManager create
        }

        return $resultCode;
    }
}