<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site web</title>
</head>

<body>
    <h2>Forgot password</h2>
    <!-- <a href="blog/validationPass?p='<?= $lien ?>'">Cliquez ici pour initialsez votre mot de passe</a>; -->
    <form method="post">
        <div class="container">
            <label for="password"><b>password</b></label>
            <input type="password" placeholder="Enter password" name="password" required>
            <label for="password"><b>password</b></label>
            <input type="password" placeholder="Enter password" name="password1" required>
            <button type="submit" value="submit" name="submit">Valider</button>
        </div>
    </form>
</body>

</html>