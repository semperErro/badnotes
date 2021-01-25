<?php

require_once '../vendor/autoload.php';
require_once '../config/bootstrap.php';

use controller\UserController;
use dao\sql\SqlDaoFactory;

session_start();


function login()
{
    if (!isset($_POST['email']) && !isset($_POST['password'])) {
        echo 'Bad request';
        return;
    }

    $daoFactory = new SqlDaoFactory();
    $dao = $daoFactory->createUserDao('users');
    $user = $dao->findByEmail($_POST['email']);
    if ($user == null) {
        echo 'No user with such an E-Mail';
        return;
    }

    $pw = $user->getPassword();
    if (!password_verify($_POST['password'], $pw)) {
        echo 'Wrong password given';
        return;
    }

    // Login User
    // session_start(); session has already been started
    $_SESSION['logged-in'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['username'] = $user->getName();
    header('location: /?page=notes'); // vorher darf kein output geschehen
}

function register()
{
    if (!isset($_POST['name']) && !isset($_POST['email']) && !isset($_POST['password']) && !isset($_POST['password-repeated'])) {
        echo '400: Bad request';
        return;
    }

    $userController = new UserController();
    $code = $userController->createUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password-repeated']);

    if ($code == UserController::SUCCESS) {
        header('location: /?page=login');
    } else {
        header('location: /?page=register');
    }
}

function logout()
{
    session_unset();
    session_destroy();
    header('location: /');
}

function post()
{
    if (!isset($_POST['action'])) {
        echo '400: Bad request';
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
            echo '400: Bad request';
    }
}

function loadPage(string $page = '')
{
    $pages = [
        'home',
        'login',
        'register',
        '404',
        'notes',
        'logout'
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

    if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] && ($page == 'login' || $page == 'register')) {
        header('location: /?page=notes');
        return;
    }

    if (in_array($page, $needAuthenticationPages) && !(isset($_SESSION['logged-in']) && $_SESSION['logged-in'])) {
        header('location: /?page=login');
        return;
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
        case 'logout':
            logout();
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