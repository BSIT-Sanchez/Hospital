<?php include_once('../hms/include/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];

    $today = date('Y-m-d');
    $stmt = $con->prepare("SELECT MAX(queue_number) AS last_queue FROM patient_ques WHERE queue_date = ?");
    $stmt->bind_param('s', $today);
    $stmt->execute();
    $stmt->bind_result($lastQueueNumber);
    $stmt->fetch();

    $lastQueueNumber = $lastQueueNumber ?? 0;

    $stmt->free_result();
    $stmt->close();

    $queueNumber = $lastQueueNumber + 1;
    $stmt = $con->prepare("INSERT INTO patient_ques (name, queue_number, queue_date) VALUES (?, ?, ?)");
    $stmt->bind_param( 'sis', $name, $queueNumber, $today);
    $stmt->execute();

    $stmt->close();

    echo "Your queue number is: " . $queueNumber;

}
?>

<br/><a href="./" >Generate New Number</a>

