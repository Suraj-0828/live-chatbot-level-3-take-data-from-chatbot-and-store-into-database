===================== live chatbot level 3 take data from chatbot and store into database backend.php ===================


<?php
// Database connection
$servername = "localhost";
$username = "root";   // Use your database username
$password = "";       // Use your database password
$dbname = "chatbot";   // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and process the input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';

    if (!empty($name) && !empty($phone)) {
        // Insert into database (Ensure your table is created first)
        $stmt = $conn->prepare("INSERT INTO chatbot_responses (name, phone) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $phone);

        if ($stmt->execute()) {
            echo "Data saved successfully!";
        } else {
            echo "Error saving data!";
        }

        $stmt->close();
    } else {
        echo "Name and phone number are required!";
    }
}

// Close connection
$conn->close();
?>


===================== backend.php ===================