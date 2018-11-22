<?php
return function($site, $pages, $page) {
    /////////////////////////////
    $servername = "localhost";
    $username = "web";
    $password = "web";
    
    
    $log = "LOG:";
    $file = null;
    
    if (isset($_POST['submit'])) {
    $target_dir = "xampp\\htdocs\\dev\\cody\\assets\\upload\\";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    $uploadOk = 1;

    $fileName = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = $content;
    fclose($fp);
    
    


    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['file']['tmp_name']);
    if ($check !== false) {
        $log .= "<br>File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $log .= "<br>File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $log .= "<br>Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 30000000) {
        $log .= "<br>Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $log .= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $log .= "<br>Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (/* move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) */1 == 1) {
            $log .= "<br>The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
            /* MYSQL */
            try {
                $conn = new PDO("mysql:host=$servername;dbname=manuel_steinber", $username, $password);
                $conn->exec("SET SESSION wait_timeout = 288000");
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $log .= "<br>Connected successfully<br><br>";

                $statement = $conn->prepare("INSERT INTO upload (name, size, type, content ) VALUES(:fileName, :fileSize, :fileType, :content)");
                /*$statement->execute(array(
                    "fileName" => $fileName,
                    "fileSize" => $fileSize,
                    "fileType" => $fileType,
                    "content" => $content
                ));*/

                /* ENCRYPTION */
                $data = base64_encode($content);
                $encrypted_data = mc_encrypt($data, ENCRYPTION_KEY);
                $base = base64_encode($encrypted_data);

                $statement->execute(array(
                    "fileName" => $fileName . '_encrypted',
                    "fileSize" => $fileSize,
                    "content" => $base,
                    "fileType" => $fileType
                ));

                $log .= "<br>File $fileName uploaded<br>";
            } catch (PDOException $e) {
                $log .= "Connection failed: " . $e->getMessage();
            }

            $conn = null;
            /* MYSQL */
        } else {
            $log .= "<br>Sorry, there was an error uploading your file.";
        }
    }

    $file = $_FILES;

    }
    
    
    ///////////////////
    return array(
        'log' => $log,
        'file' => $file
    );
};
