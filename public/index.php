<?php

use controller\UserController;
use repository\IUserRepository;
use User\UserRepository;

session_start();

const PAGES_DIR = '../view/pages/';

function login()
{
    if (!isset($_POST['email']) && !isset($_POST['passwd'])) {
        echo 'Bad request';
        return;
    }

    $entityManager = getEntityManager();
    /** @var IUserRepository $userRepo */
    $userRepo = $entityManager->getRepository(UserRepository::class);
    $user = $userRepo->findByEmail($_POST['email']);
    if ($user == null) {
        echo 'No user with such an E-Mail';
        return;
    }

    $pw = $user->getPassword();
    if (password_verify($_POST['passwd'], $pw)) {
        echo 'Wrong password given';
        return;
    }

    // Login User
    session_start();
    $_SESSION['logged-in'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['username'] = $user->getName();
    header('location: ' . PAGES_DIR . 'home.php');
}

function register()
{
    if (!isset($_POST['name']) && !isset($_POST['email']) && !isset($_POST['passwd']) && !isset($_POST['passwd-repeated'])) {
        echo 'Bad request';
        return;
    }

    $userController = new UserController();
    $userController->createUser($_POST['name'], $_POST['email'], $_POST['passwd'], $_POST['passwd-repeated']);
    header('location: ' . PAGES_DIR . 'login.php');
}

function post()
{
    if (!isset($_POST['action'])) {
        echo 'Bad request';
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
            echo 'Bad request';
    }
}

function loadPage(string $page = '')
{
    $pages = [
        'home',
        'login',
        'register',
        '404',
        'notes'
    ];
    $needAuthenticationPages = [
        'notes'
    ];

    if ($page == '') {
        if (!isset($_GET['page'])) {
            $page = 'home';
        } else {
            $page = $_GET['page'];
        }
    }

    if (!in_array($page, $pages)) {
        $page = '404';
    }

    if (in_array($page, $needAuthenticationPages) && !(isset($_SESSION['logged-in']) && $_SESSION['logged-in'])) {
        $page = 'login';
    }
    include '../view/skeleton.php'; // $page is used here
}

function get()
{
    if (!isset($_GET['action'])) {
        $_GET['action'] = 'load-page';
    }

    switch ($_GET['action']) {
        case 'load-page':
            loadPage();
            break;
        default:
            echo '400: Unknown action';
    }
}

function main()
{
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            post();
            break;
        case 'GET':
            get();
            break;
        default:
            echo '400: Bad request';
    }
}

main();