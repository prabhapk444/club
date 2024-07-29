<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
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
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input[type="text"],
        .form-container input[type="file"] {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #FFA500;
            color: white;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #e69500;
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
        <h3>Leaders Information</h3>
        <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" name="leadername" placeholder="Leader Name" required>
            <input type="text" name="role" placeholder="Role" required>
            <input type="file" name="photo" required>
            <input type="submit" name="submit" value="Submit" class="btn btn-warning">
        </form>

        <div class="icons-container">
            <a href="updateleaders.php" class="update-icon"><i class="fas fa-edit"></i> Update</a>
            <a href="deleteleaders.php" class="delete-icon"><i class="fas fa-trash-alt"></i> Delete</a>
            <a href="viewleaders.php" class="view-icon"><i class="fas fa-eye"></i>view</a> 
        </div>
    </div>

    <?php
include './../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    $leadername = $conn->real_escape_string($_POST['leadername']);
    $role = $conn->real_escape_string($_POST['role']);
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $fileName = basename($_FILES['photo']['name']);
    $uploadFile = $uploadDir . $fileName;

    $imageType = $_FILES['photo']['type'];

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

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {

        compressImage($uploadFile, $uploadFile, 75);

        $filePath = $conn->real_escape_string($uploadFile);

        $sql = "INSERT INTO leaders (leadername, role, photo) VALUES ('$leadername', '$role', '$filePath')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data inserted successfully.'
                        });
                    }, 100);
                  </script>";
        } else {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: " . $sql . "<br>" . $conn->error . "'
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
