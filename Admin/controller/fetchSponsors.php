<?php
header('Content-Type: application/json'); 

include './../conn.php';
include './../service/frontend.php'; 

$sponsers = getSponsers($conn);

echo json_encode($sponsers); 

$conn->close();
?>
