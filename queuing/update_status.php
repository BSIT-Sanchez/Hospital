<?php
include_once('../hms/include/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    if (isset($_POST['action']) && $_POST['action'] === 'updateStatus') {
        $patientId = $_POST['patientId'];
        $newStatus = $_POST['newStatus'];


        $stmt = $con->prepare("UPDATE patient_ques SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $newStatus, $patientId);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
        }

        $stmt->close();
    }

    if (isset($_POST['action']) && $_POST['action'] === 'moveToQueue') {
        $patientId = $_POST['patientId'];

        
        $stmt = $con->prepare("UPDATE patient_ques SET status = 'Waiting' WHERE id = ?");
        $stmt->bind_param('i', $patientId);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Patient moved back to Queue List']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to move patient back to Queue List']);
        }

        $stmt->close();
    }
    exit;
}
?>
