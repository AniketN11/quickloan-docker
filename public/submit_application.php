<?php

require_once __DIR__ . '/../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $loan_type = $_POST['loan_type'];

    $sql = "INSERT INTO applications
            (name, contact, email, loan_type)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssss",
        $name,
        $contact,
        $email,
        $loan_type
    );

    if ($stmt->execute()) {

        header("Location: index.html");
        exit;

    } else {

        echo "Application submission failed.";

    }

    $stmt->close();
    $conn->close();
}
?>
