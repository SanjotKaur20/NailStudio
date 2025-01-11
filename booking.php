<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nailwebsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $staff = $_POST['staff'];
    $date = $_POST['date'];

    // Insert form data into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO booking (FirstName, LastName, Email, Phone, Service, Staff, Date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstName, $lastName, $email, $phone, $service, $staff, $date);
    if ($stmt->execute()) {
        echo "Booking successfully completed.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
