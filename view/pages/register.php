<form method="post" action="/api.php">
    <input type="hidden" name="action" value="register">
    <label for="name">Name:</label><br>

    <input type="text" id="name" name="name"><br>
    <label for="email">E-Mail:</label><br>

    <input type="email" id="email" name="email"><br>
    <label for="passwd">Password:</label><br>

    <input type="password" id="passwd" name="passwd">
    <label for="passwd">Repeat Password:</label><br>

    <input type="password" id="passwd-repeat" name="passwd-repeat">

    <input type="checkbox" id="terms" name="terms" value="Terms">
    <label for="terms"> I accept the terms and conditions.</label><br>

    <input type="submit" value="Register">
</form>