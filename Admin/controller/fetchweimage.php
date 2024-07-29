<?php
header('Content-Type: application/json'); 

include './../conn.php';
include './../service/frontend.php'; 

$weImages = getWeImages($conn);

echo json_encode($weImages); 

$conn->close();

?>