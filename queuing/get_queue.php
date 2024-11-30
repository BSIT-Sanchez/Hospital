<?php include_once('../hms/include/config.php'); 

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $stmt = $con->prepare("SELECT id, name, queue_number, status FROM patient_ques WHERE queue_date = ? AND status IN ('Waiting', 'Consulting') ORDER BY queue_number");
    $today = date('Y-m-d');
    $stmt->bind_param('s', $today);
    $stmt->execute();
    $result = $stmt->get_result();

    
    $queueList = [];
    $nextInLine = null;
    while ($row = $result->fetch_assoc()) {
        $queueList[] = $row;

       
        if ($nextInLine === null && $row['status'] === 'Waiting') {
            $nextInLine = $row;
        }
    }

   
    $stmt->close();

   
    $stmt = $con->prepare("SELECT id, name, queue_number, status FROM patient_ques WHERE queue_date = ? AND status IN ('Completed', 'Cancelled') ORDER BY queue_number");
    $stmt->bind_param('s', $today);
    $stmt->execute();
    $result = $stmt->get_result();

   
    $completedList = [];
    while ($row = $result->fetch_assoc()) {
        $completedList[] = $row;
    }

 
    $stmt->close();

    $response = [
        'queueList' => $queueList,    
        'nextInLine' => $nextInLine,  
        'completedList' => $completedList
    ];

    
    header('Content-Type: application/json');
    echo json_encode($response);  
    exit;
}
?>