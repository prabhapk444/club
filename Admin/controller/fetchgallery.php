<?php
header('Content-Type: application/json'); 

include './../conn.php';
include './../service/frontend.php'; 

$gallery = getGalleryImages($conn);

echo json_encode($gallery); 

$conn->close();
?>
