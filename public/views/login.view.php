<main>
    <h2>Login</h2>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="/webshop/public/views/layouts/login.main.php" method="post">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    <a href="/webshop/public/views/register.view.php">Neuen Account erstellen</a>
</main>