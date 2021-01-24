<form method="post" action="/">
    <input type="hidden" name="action" value="register">

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>

    <label for="email">E-Mail:</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>

    <label for="password">Repeat Password:</label><br>
    <input type="password" id="password-repeated" name="password-repeated"><br>

    <input type="checkbox" id="terms" name="terms" value="Terms">
    <label for="terms"> I accept the terms and conditions.</label><br>

    <input type="submit" value="Register">

    <p>Schon registriert? <a href="/?page=login">Melde dich hier an.</a></p>
</form>