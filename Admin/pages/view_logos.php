<?php
include './../conn.php';

$sql = "SELECT ourlogo FROM logo ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $logoPath = $row['ourlogo'];
    echo "<img src='$logoPath' alt='Uploaded Logo'>";
} else {
    echo "No logo uploaded yet.";
}

$conn->close();
?>
