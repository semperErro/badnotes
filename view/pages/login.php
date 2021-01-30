<? include "../view/templates/header.php" ?>
<div class="container">
    <form method="post" action="/" class="was-validated">
        <input type="hidden" name="action" value="login"><br>

        <div class="form-group">
            <label for="email">E-Mail:</label><br>
            <input type="email" id="email" name="email" class="form-control" required
                   placeholder="Gebe hier Deine E-Mail ein"><br>
        </div>

        <div class="form-group">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" class="form-control" required
                   placeholder="Gebe hier Dein Passwort ein"><br>
        </div>

        <div class="form-group form-check">
            <label for="remember" class="form-check-label">
                <input type="checkbox" id="remember" name="remember" class="form-check-input" value="Remember">Remember me.
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Einloggen</button>
        <br><br>

        <p>Noch nicht registriert? <a href="/?page=register">Registriere dich hier.</a></p>
    </form>
</div>