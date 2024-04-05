<?php

require_once ("Sesija.class.php");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$dbPath = 'sqlite:./ctf.db';


try {
    $pdo = new PDO($dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepared statement to fetch the user by username
    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        $sesija = new Sesija();
        $sesija->kreirajKorisnika("admin");
        header("Location: ./admin-panel.php");
    } else {
        echo "login fail";
        header("Location: ./index.html");
    }
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>