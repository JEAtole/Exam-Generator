<?php

    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $type = $_POST['type'];

        if($type == "mcq"){
            $filePath = "mcq/mcq-qna.json";
        } else if ($type == "owa"){
            $filePath = "owa/owa-qna.json";
        } else if ($type == "tof") {
            $filePath = "tof/tof-qna.json";
        }

        file_put_contents($filePath, $content);
        
        echo "goods";
        // Process the received string (e.g., save it to a file, store in a database, etc.)
    } else {
        echo "error";
    }

?>