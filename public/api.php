<?php

use controller\UserController;
use repository\IUserRepository;
use User\UserRepository;

session_start();

function login()
{
    if (!isset($_POST['email']) && !isset($_POST['passwd'])) {
        echo "Bad request";
        return;
    }

    $entityManager = getEntityManager();
    /** @var IUserRepository $userRepo */
    $userRepo = $entityManager->getRepository(UserRepository::class);
    $user = $userRepo->findByEmail($_POST['email']);
    if ($user == null) {
        echo "No user with such an E-Mail";
        return;
    }

    $pw = $user->getPassword();
    if (password_verify($_POST['passwd'], $pw)) {
        echo "Wrong password given";
        return;
    }

    // Login User
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['username'] = $user->getName();
    header('location: home.php');
}

function register()
{
    if (!isset($_POST['name']) && !isset($_POST['email']) && !isset($_POST['passwd']) && !isset($_POST['passwd-repeated'])) {
        echo "Bad request";
        return;
    }

    $userController = new UserController();
    $userController->createUser($_POST["name"], $_POST["email"], $_POST["passwd"], $_POST["passwd-repeated"]);
    header('location: login.php');
}

function post()
{
    if (!isset($_POST['action'])) {
        echo "Bad request";
        return;
    }

    switch ($_POST['action']) {
        case 'login':
            login();
            break;
        case 'register':
            register();
            break;
        default:
            echo "Bad request";
    }
}

function main()
{
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            post();
            break;
        default:
            echo "Bad request";
    }
}

main();