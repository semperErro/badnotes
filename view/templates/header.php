<nav class="navbar navbar-expand-sm shadow-sm sticky-top <?= /** @var TextManager $texts */
$texts->getParam('theme') == 'dark' ? 'bg-dark navbar-dark' : '' ?>">
    <a class="navbar-brand" href="/">
        <!--        <img src="../../view/res/tux.svg" alt="Logo">-->
        <h1 style="display: inline"><?=

            $texts->hasParam('header-show-title') ? $texts->getBaseText('app-title') : '' ?></h1>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
        </ul>
        <span class="flex-grow-1"></span>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php $lbl = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'Logout' : 'Login';
                $loginLink = '/?page=login';
                $logoutLink = '/?action=logout'; ?>
                <a class="nav-link" href="<?= $lbl == 'Logout' ? $logoutLink : $loginLink; ?>"><?= $lbl ?></a>
                <!-- TODO: href according to $lbl -->
            </li>
            <? if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/?page=register">Register</a>
                </li>
            <? endif; ?>
            <? if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li class="nav-item">
                <a class="nav-link"
                   href="/?page=notes&theme=<?= $texts->getParam('theme') == 'dark' ? 'light' : 'dark' ?>">
                    <?= $texts->getParam('theme') == 'dark' ? 'Light' : 'Dark' ?>
                </a>
            </li>
            <? endif; ?>
        </ul>
    </div>
</nav>