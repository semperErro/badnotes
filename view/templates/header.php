<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/">
        <img src="../../view/res/tux.svg" alt="Logo">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
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