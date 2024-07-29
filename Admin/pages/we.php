<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Where We Images</title>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            padding: 30px;
            width: 80%;
            max-width: 500px;
        }
        .form-container h4 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input[type="file"] {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .icons-container {
            text-align: center;
            margin-top: 20px;
        }
        .icons-container a {
            margin: 0 10px;
            color: #007bff; 
            text-decoration:none;
        }
        .icons-container a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h4>Where We Images Here</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <input type="submit" value="Upload Image" class="btn btn-warning">
        </form>
        <div class="icons-container">
            <a href="weupdate.php" class="update-icon"><i class="fas fa-edit"></i> Update</a>
            <a href="wedelete.php" class="delete-icon"><i class="fas fa-trash-alt"></i> Delete</a>
        </div>
       
    </div>

    <script>
        function updateImage() {
            Swal.fire({
                title: 'Update Image',
                text: 'This feature is not implemented yet.',
                icon: 'info'
            });
        }

        function deleteImage() {
            Swal.fire({
                title: 'Delete Image',
                text: 'This feature is not implemented yet.',
                icon: 'info'
            });
        }
    </script>
  <?php
include './../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $fileName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $fileName;
    function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
            imagepng($image, $destination, $quality / 10);
        }
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        compressImage($uploadFile, $uploadFile, 75);

        $filePath = $conn->real_escape_string($uploadFile);
        $sql = "INSERT INTO weimages (photo) VALUES ('$filePath')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Image uploaded and compressed successfully.'
                        });
                    }, 100);
                  </script>";
        } else {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: " . $conn->error . "'
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
                        text: 'Failed to upload file.'
                    });
                }, 100);
              </script>";
    }
}

$conn->close();
?>

</body>
</html>