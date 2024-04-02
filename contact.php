<?php

$dbPath = 'sqlite:./ctf.db';

try {
    // Create a new PDO connection to the SQLite database
    $db = new PDO($dbPath);
    // Set error mode to exception to catch potential errors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Collect input from POST request
    $name = $_POST['name'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // SQL query with placeholders for the actual values
    $sql = "INSERT INTO contact (name, subject, message) VALUES (:name, :subject, :message)";

    // Prepare the SQL statement
    $stmt = $db->prepare($sql);

    // Bind values to the placeholders
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    // Execute the statement
    $stmt->execute();

    echo "Record inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$db = null;

header("Location: ./index.html");
exit;
?>