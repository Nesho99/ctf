<?php

$dbPath = 'sqlite:./ctf.db';

try {
   
    $db = new PDO($dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $name = $_POST['name'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    $sql = "INSERT INTO contact (name, subject, message) VALUES (:name, :subject, :message)";

   
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    $stmt->execute();

    echo "Red uspiješno unesen.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$db = null;

header("Location: ./index.html");
exit;
?>