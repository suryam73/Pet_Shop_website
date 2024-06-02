<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "upload/"; // Directory where images will be uploaded
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

 
    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // Adjust the size limit as needed
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif"&& $imageFileType != "avif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to move uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert image path into the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pet";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $imagePath = mysqli_real_escape_string($conn, $targetFile);

            $sql = "INSERT INTO images (image_path) VALUES ('$imagePath')";

            if ($conn->query($sql) === TRUE) {
                echo "The file ". basename($_FILES["image"]["name"]). " has been uploaded and inserted into the database.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="file"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 10px;
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .go-back-btn {
            display: block;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        .go-back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Image</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="image">Select image to upload:</label>
            <input type="file" name="image" id="image">
            <input type="submit" value="Upload Image" name="submit">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])): ?>
                <?php if ($uploadOk == 0): ?>
                    <p class="message error">Sorry, your file was not uploaded.</p>
                <?php else: ?>
                    <p class="message success">The file <?php echo basename($_FILES["image"]["name"]); ?> has been uploaded and inserted into the database.</p>
                <?php endif; ?>
            <?php endif; ?>
        </form>
        <a href="index.php" class="go-back-btn">Go to Index Page</a>
    </div>
</body>
</html>
