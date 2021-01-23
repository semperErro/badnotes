<form method="post" action="/api.php">
    <input type="hidden" name="action" value="login">

    <label for="email">E-Mail:</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="passwd">Password:</label><br>
    <input type="password" id="passwd" name="passwd">

    <input type="checkbox" id="remember" name="remember" value="Remember">
    <label for="remember"> Remember me.</label><br>

    <input type="submit" value="Login">
</form>