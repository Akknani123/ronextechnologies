<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "@bajaraang123";
$dbname = "contactform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Message submitted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
