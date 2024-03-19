<!DOCTYPE html>
<html>
<head>
    <title>Inloggen</title>
</head>
<body>

<h2>Inloggen</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === 'admin' && $password === 'password') {
            header("Location: home.php ");
            exit;
        } else {
            echo "<p>Gebruikersnaam of wachtwoord is onjuist!</p>";
        }
    } else {
        echo "<p>Vul zowel gebruikersnaam als wachtwoord in.</p>";
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" name="username" id="username" required>
    <br><br>
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password" required>
    <br><br>
    <a href="index.php"><button>submit</button></a>
</form>

</body>
</html>
