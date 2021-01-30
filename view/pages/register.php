<? include "../view/templates/header.php" ?>

<div class="container">
    <form method="post" action="/" class="was-validated">
        <input type="hidden" name="action" value="register"><br>

        <div class="form-group">
            <label for="name">Name:</label><br>
            <input type="text" class="form-control" id="name" name="name" required><br>
        </div>

        <div class="form-group">
            <label for="email">E-Mail:</label><br>
            <input type="email" class="form-control" id="email" name="email" required><br>
        </div>

        <div class="form-group">
            <label for="password">Password:</label><br>
            <input type="password" class="form-control" id="password" name="password" required><br>
        </div>

        <div class="form-group">
            <label for="password">Repeat Password:</label><br>
            <input type="password" class="form-control" id="password_repeated" name="password_repeated" required><br>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" id="terms" name="terms" value="Terms">
            <label for="terms"> I accept the terms and conditions.</label><br>
        </div>

        <button class="btn btn-primary" type="submit" value="Register">Registrieren</button>
        <br><br>

        <p>Schon registriert? <a href="/?page=login">Melde dich hier an.</a></p>
    </form>
</div>