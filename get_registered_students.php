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

// Retrieve registered students' information from the "players" table
$sql = "SELECT name, age, email, phone, college_name, registration_number, address, bonafide_certificate FROM players";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each registered student
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. "<br>";
        echo "Age: " . $row["age"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Phone: " . $row["phone"]. "<br>";
        echo "College Name: " . $row["college_name"]. "<br>";
        echo "Registration Number: " . $row["registration_number"]. "<br>";
        echo "Address: " . $row["address"]. "<br>";
        echo "Bonafide Certificate: " . $row["bonafide_certificate"]. "<br><br>";
    }
} else {
    echo "No registered students.";
}

// Close the database connection
$conn->close();

?>
