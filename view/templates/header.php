<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/">
<!--        <img src="../view/res/tux.png" alt="Logo">-->
        <h1 style="display: inline"><?=
            /** @var TextManager $texts */
            $texts->hasParam('title-in-header') ? $texts->getBaseText('app-title') : '' ?></h1>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/?page=register">Hallo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/?page=register">Welt</a>
            </li>
        </ul>
        <span class="flex-grow-1"></span>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php $lbl = isset($_SESSION['logged-in']) && $_SESSION['logged-in'] ? 'Logout' : 'Login';
                $loginLink = '/?page=login';
                $logoutLink = '/?action=logout'; ?>
                <a class="nav-link" href="<?= $lbl == 'Logout' ? $logoutLink : $loginLink; ?>"><?= $lbl ?></a>
                <!-- TODO: href according to $lbl -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/?page=register">Register</a>
            </li>
        </ul>
    </div>
</nav>