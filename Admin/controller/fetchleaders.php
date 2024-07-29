<?php
header('Content-Type: application/json'); 

include './../conn.php';
include './../service/frontend.php'; 

$leaders = getLeaders($conn);

echo json_encode($leaders); 

$conn->close();
?>
