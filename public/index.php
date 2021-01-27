<?php

require_once '../vendor/autoload.php';
require_once '../config/bootstrap.php';
require_once '../view/TextManager.php';

use controller\NoteController;
use controller\UserController;
use dao\sql\SqlDaoFactory;

session_start();


function getUserController(): UserController
{
    $factory = new SqlDaoFactory();
    return new UserController($factory->createUserDao('users'));
}

function getNoteController(): NoteController
{
    $factory = new SqlDaoFactory();
    return new NoteController($factory->createNoteDao('notes'));
}

function login(): void
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
    $_SESSION['user-id'] = $user->getId();
    $_SESSION['username'] = $user->getName();
    header('location: /?page=notes'); // vorher darf kein output geschehen
}

function register(): void
{
    if (!isset($_POST['name']) && !isset($_POST['email']) && !isset($_POST['password']) && !isset($_POST['password-repeated'])) {
        die('400: Bad request');
    }

    $userController = getUserController();
    $code = $userController->createUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password-repeated']);

    if ($code == UserController::SUCCESS) {
        header('location: /?page=login');
    } else {
        header('location: /?page=register');
    }
}

function logout(): void
{
    session_unset();
    session_destroy();
    header('location: /');
}

function createNote(): void
{
    if (!isset($_SESSION['user-id'])) {
        die('400: Bad request');
    }

    $controller = getNoteController();
    $controller->createNote('', '', time(), $_SESSION['user-id']);
}

function updateNote(): void
{
    if (!isset($_SESSION['user-id'])) {
        die('400: Bad request');
    }
    if (!isset($_POST['note-id']) || !isset($_POST['title']) || !isset($_POST['text'])) {
        die('400: Bad request');
    }

    $controller = getNoteController();
    $controller->updateNote($_POST['note-id'], $_POST['title'], $_POST['text'], time(), $_SESSION['user-id']);
}

function deleteNote(): void
{
    if (!isset($_SESSION['user-id'])) {
        die('400: Bad request');
    }
    if (!isset($_POST['note-id'])) {
        die('400: Bad request');
    }

    $controller = getNoteController();
    $controller->deleteNote($_POST['note-id']);
}

function post(): void
{
    if (!isset($_POST['action'])) {
        die('400: Bad request');
    }

    switch ($_POST['action']) {
        case 'login':
            login();
            break;
        case 'register':
            register();
            break;
        case 'create-note':
            createNote();
            break;
        case 'update-note':
            updateNote();
            break;
        case 'delete-note':
            deleteNote();
            break;
        default:
            die('400: Bad request');
    }
}

function loadPage(string $page = ''): void
{
    $texts = new TextManager();
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
    if ($page == 'notes') {
        $notes = getNoteController()->getNotesByUserId($_SESSION['user-id']);
        if ($notes == 0) {
            die('400: Bad request');
        }
        $texts->addParam('notes', $notes);
        if (count($notes)) {
            $texts->addParam('open-note-id', $notes[0]->getId());
        }
    }
    include '../view/skeleton.php'; // $page is used here
}

function get(): void
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
            die('400: Unknown action');
    }
}

function main(): void
{
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            post();
            break;
        case 'GET':
            get();
            break;
        default:
            die('400: Bad request');
    }
}

main();