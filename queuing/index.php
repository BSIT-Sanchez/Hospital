<?php include_once('../hms/include/config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Clinic Queue</title>
</head>
<body>
    <h1>Patient Queue</h1>
    <p>Please enter your name and click 'Get Queue Number' to recive your queue number.</p>

    <!-- Add Patient Form -->
    <form action="add_patient.php" method="post">
        <label for="name">Patient Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <br>
        <button type="submit">Get Queue Number</button>
    </form>


</body>
</html>
