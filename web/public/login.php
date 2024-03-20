<?php
declare(strict_types=1);
session_start(); // Starte eine Session
require '../app/classes/Connection.php';

// Datenbankverbindung herstellen
$connection = new Connection();

// Überprüfe, ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzername aus dem Formular lesen
    $username = $_POST['username'];

    // SQL-Abfrage, um Benutzerdaten abzurufen
    $sql = "SELECT (password) FROM person WHERE username = ?";

    // SQL-Abfrage vorbereiten
    $stmt = $connection->getConnection()->query($sql);

    // Parameter binden
    $stmt->bind_param("s", $username);

    // SQL-Abfrage ausführen
    $stmt->execute();

    // Ergebnis der Abfrage holen
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Benutzer gefunden
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // Passwort aus dem Formular lesen
        $password = $_POST['password'];

        // Überprüfe das eingegebene Passwort mit dem verschlüsselten Passwort
        if (password_verify($password, $hashed_password)) {
            // Anmeldung erfolgreich
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: geschuetzte_seite.php'); // Weiterleitung zur geschützten Seite
            exit;
        } else {
            // Falsche Anmeldeinformationen
            $error = "Falsche Anmeldeinformationen";
        }
    } else {
        // Falsche Anmeldeinformationen
        $error = "Falsche Anmeldeinformationen";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if(isset($error)) { echo $error; } ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Benutzername:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Anmelden">
</form>
</body>
</html>
