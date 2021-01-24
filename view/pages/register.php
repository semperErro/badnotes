<form method="post" action="/">
    <input type="hidden" name="action" value="register">

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>

    <label for="email">E-Mail:</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="passwd">Password:</label><br>
    <input type="password" id="passwd" name="passwd"><br>

    <label for="passwd">Repeat Password:</label><br>
    <input type="password" id="passwd-repeat" name="passwd-repeat"><br>

    <input type="checkbox" id="terms" name="terms" value="Terms">
    <label for="terms"> I accept the terms and conditions.</label><br>

    <input type="submit" value="Register">

    <p>Schon registriert? <a href="/?page=login">Melde dich hier an.</a></p>
</form>