

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Where We Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 500px;
        }
        .form-container h4 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input[type="text"] {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }
        
    </style>
</head>
<body>
    <div class="form-container">
        <h4>Delete Gallery Image</h4>
        <form action="wedelete.php" method="post" autocomplete="off">
            <input type="text" name="id" placeholder="Image ID" required>
            <input type="submit" value="Delete Image" class="btn btn-danger">
        </form>
    </div>
    <?php
include './../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $sql_select = "SELECT photo FROM weimages WHERE id = '$id'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['photo'];

       
        $sql_delete = "DELETE FROM gallery WHERE id = '$id'";

        if ($conn->query($sql_delete) === TRUE) {
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Image deleted successfully.'
                        });
                    }, 100);
                  </script>";
        } else {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error deleting image: " . $conn->error . "'
                        });
                    }, 100);
                  </script>";
        }
    } else {
        echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Image not found.'
                    });
                }, 100);
              </script>";
    }
}

$conn->close();
?>
</body>
</html>
