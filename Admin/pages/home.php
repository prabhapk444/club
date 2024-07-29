<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Upload</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .upload-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 400px;
        }
        .upload-box h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .upload-box input[type="file"] {
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .upload-box input[type="submit"], .upload-box .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .upload-box input[type="submit"] {
            background-color: #FFA500;
            color: white;
        }
        .upload-box .btn {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 10px;
        }
        .view-icon {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="upload-box">
        <h3>New logo upload here</h3>
        <form action="#" method="post" enctype="multipart/form-data" autocmplete="off">
            <input type="file" name="logo" required>
            <input type="submit" name="submit" value="Upload" class="btn btn-warning">
            <a href="./view_logos.php" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i> View Logos</a>
        </form>
    </div>
    
    
    <?php
    include './../conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['logo'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['logo']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadFile)) {
            $compressedFile = $uploadDir . 'compressed_' . $fileName;
            compressImage($uploadFile, $compressedFile, 75);
            $filePath = $conn->real_escape_string($compressedFile);
            $sqlCheck = "SELECT COUNT(*) AS count FROM logo";
            $result = $conn->query($sqlCheck);
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $sql = "UPDATE logo SET ourlogo = '$filePath'";
            } else {
                $sql = "INSERT INTO logo (ourlogo) VALUES ('$filePath')";
            }
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'File uploaded and compressed successfully.'
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

    function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }

        imagejpeg($image, $destination, $quality);
        imagedestroy($image);
    }
    ?>

</body>
</html>