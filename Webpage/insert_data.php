<?php
$servername = "localhost";
$username = "id20523381_root";
$password = "srC^X//2Bld&v&=S";
$dbname = "id20523381_iotsensorr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive data from the ESP32
$sensor_status = $_POST['sensor_status'];
$led_status = $_POST['led_status'];

// Insert data into the database
$sql = "INSERT INTO sensor_logs (sensor_status, led_status) VALUES ('$sensor_status', '$led_status')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
