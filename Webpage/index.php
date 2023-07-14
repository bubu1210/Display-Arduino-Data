<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="5" >
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

	<title>Motion Sensor Data </title>

</head>

<body>

    <h1>MOTION SENSOR DATA</h1>
    
    
<?php
$servername = "localhost";
$username = "id20523381_root";
$password = "srC^X//2Bld&v&=S";
$dbname = "id20523381_iotsensorr";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the data from the table
$sql = "SELECT id, sensor_status, led_status, date_stamp, time_stamp FROM sensor_logs ORDER BY id DESC";

// Execute the query
$result = mysqli_query($conn, $sql);

// Display the data in a table
if (mysqli_num_rows($result) > 0) {
    // Change the background color based on the led_status value

    echo "<table>
            <tr>
                <th>ID</th>
                <th>Sensor Status</th>
                <th>LED Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["sensor_status"]."</td>
                        <td>".$row["led_status"]."</td>
                        <td>".$row["date_stamp"]."</td>
                        <td>".$row["time_stamp"]."</td>
                    </tr>";
                if ($row["led_status"] == 1) {
                    echo '<body style="background-color: yellow;">';
                    echo "  <tr><td colspan='5' >The light was on! </td> <!--this is the corresponding column--> </tr>";
                } else {
                        echo '<body style="background-color: dark-yellow;">';
                        }
    }
    echo "</table>";
} else {
    echo "No data found!";
}

// Close the connection
mysqli_close($conn);
?>

	</body>
</html>