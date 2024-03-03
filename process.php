<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cricket_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$collegeName = $_POST['collegeName'];
$registrationNumber = $_POST['registrationNumber'];
$address = $_POST['address'];

// Check if the "bonafideCertificate" key is set in the $_FILES array
if (isset($_FILES['bonafideCertificate'])) {
    // Check for errors during file upload
    if ($_FILES['bonafideCertificate']['error'] === 0) {
        $bonafideCertificate = $_FILES['bonafideCertificate']['name'];

        // Move uploaded file to a designated directory
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['bonafideCertificate']['name']);

        // Allow only specific file types
        $allowedExtensions = array("jpg", "jpeg", "png", "pdf");
        $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            move_uploaded_file($_FILES['bonafideCertificate']['tmp_name'], $targetFile);
        } else {
            echo "Error: Only JPG, JPEG, PNG, and PDF files are allowed.";
            exit();
        }
    } else {
        // Handle file upload errors
        echo "Error during file upload. Code: " . $_FILES['bonafideCertificate']['error'];
        exit();
    }
} else {
    // If "bonafideCertificate" key is not set, handle it accordingly (you may want to display an error message)
    echo "Error: Bonafide Certificate file not uploaded.";
    exit();
}

// Use prepared statement to prevent SQL injection
$sql = "INSERT INTO players (name, age, email, phone, college_name, registration_number, address, bonafide_certificate) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssss", $name, $age, $email, $phone, $collegeName, $registrationNumber, $address, $bonafideCertificate);

if ($stmt->execute()) {
    echo "Registration successful";
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
