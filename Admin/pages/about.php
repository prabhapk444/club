<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #f2f2f2; */
            display: flex;
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
        .form-container h3 {
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
        <h3>About Us</h3>
        <form action="#" method="post" autocomplete="off">
            <textarea name="content" rows="5" placeholder="Enter your content here..." required></textarea>
            <textarea name="wherewas" rows="5" placeholder="Enter wherewas text here..." required></textarea>
            <textarea name="roaring" rows="5" placeholder="Enter roaring text here..." required></textarea>
            <input type="submit" name="submit" value="Submit" class="btn btn-warning">
        </form>
    </div>

    <?php
    include './../conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = $conn->real_escape_string($_POST['content']);
        $wherewas = $conn->real_escape_string($_POST['wherewas']);
        $roaring = $conn->real_escape_string($_POST['roaring']);

        $sqlCheck = "SELECT COUNT(*) AS count FROM about";
        $result = $conn->query($sqlCheck);
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $sql = "UPDATE about SET content = '$content', wherewas = '$wherewas', roaring = '$roaring'";
        } else {
            $sql = "INSERT INTO about (content, wherewas, roaring) VALUES ('$content', '$wherewas', '$roaring')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Content " . ($row['count'] > 0 ? "updated" : "inserted") . " successfully.'
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
    }

    $conn->close();
    ?>
</body>
</html>
