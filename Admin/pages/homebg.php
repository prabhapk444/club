<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
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
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 500px;
        }
        .form-container h5 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container textarea {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            resize: vertical;
        }
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
    </style>
</head>
<body>
    <div class="form-container">
        <h5>Background Image and Text Upload</h5>
        <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <textarea name="description" rows="5" placeholder="Enter your text here..." required></textarea>
            <input type="file" name="background_image" required>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

    <?php
    include './../conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['background_image'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $description = $conn->real_escape_string($_POST['description']);
        $fileName = basename($_FILES['background_image']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['background_image']['tmp_name'], $uploadFile)) {
            $compressedFile = $uploadDir . 'compressed_' . $fileName;
            compressImage($uploadFile, $compressedFile, 75);
            
            $filePath = $conn->real_escape_string($compressedFile);
            
            $sqlCheck = "SELECT COUNT(*) AS count FROM homebg";
            $result = $conn->query($sqlCheck);
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $sql = "UPDATE homebg SET homeimage = '$filePath', hometext = '$description'";
            } else {
                $sql = "INSERT INTO homebg (homeimage, hometext) VALUES ('$filePath', '$description')";
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
