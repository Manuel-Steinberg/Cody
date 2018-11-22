<?php

return function($site, $pages, $page) {
    /////////////////////////////
    $log = "LOG:";
    
    $servername = "localhost";
    $username = "web";
    $password = "web";
    if (isset($_GET['id'])) {
        // if id is set then get the file with the id from database

        /* MYSQL */
        try {
            $conn = new PDO("mysql:host=$servername;dbname=manuel_steinber", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $conn->prepare("SELECT type, content, size, name FROM upload WHERE id = :id");
            $statement->execute(array(
                "id" => $_GET['id']
            ));

            $statement->bindColumn(1, $type, PDO::PARAM_STR, 256);
            $statement->bindColumn(2, $blob, PDO::PARAM_LOB);
            $statement->bindColumn(3, $size, PDO::PARAM_INT);
            $statement->bindColumn(4, $name, PDO::PARAM_STR, 256);
            $statement->fetch(PDO::FETCH_BOUND);

            //$log .= '<img id="img" class="center fit" src="data:' . $type . ';base64,' . base64_encode($blob) . '"/>';
            $log .= '<img id="img_enc" class="center fit" src="data:' . $type . ';base64,' . base64_encode(base64_decode(mc_decrypt(base64_decode($blob), ENCRYPTION_KEY))) . '"/>';
        } catch (PDOException $e) {
            $log .= "Connection failed: " . $e->getMessage();
        }

        $conn = null;
    }

    ///////////////////
    return array(
        'log' => $log
    );
};
