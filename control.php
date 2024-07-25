<?php

    if (isset($_POST['command'])) {
        $command = $_POST['command'];

        if ($command = "cleanup") {

            // Define the path to the uploads folder
            $uploadsFolder = 'uploads/';

            // Get a list of all files in the uploads folder
            $uploadfiles = glob($uploadsFolder . '*');

            // Loop through each file and delete it
            foreach ($uploadfiles as $file) {
                // Check if the path is a file (not a directory)
                if (is_file($file)) {
                    // Delete the file
                    unlink($file);
                }
            }

            // Define the path to the session folder
            $sessionFolder = 'C:/xampp/tmp';

            // Get a list of all files in the session folder
            $sessionfiles = scandir($sessionFolder);

            // Loop through each file and delete it
            foreach ($sessionfiles as $file) {
                // Check if the path is a file (not a directory) and is a session file
                if (is_file($sessionFolder . '/' . $file)) {
                    // Delete the session file
                    if (!unlink($sessionFolder . '/' . $file)) {
                        echo "Error deleting file: " . $sessionFolder . '/' . $file;
                    }
                }
            }

        } else if ($command = "checkUploads") {

            $directory = 'uploads/';
            $files = scandir($directory);

            // Exclude . and .. from the list of files
            $files = array_diff($files, array('.', '..'));

            if (empty($files)) {
                // Directory is empty
                http_response_code(204); // No content
            } else {
                // Directory is not empty
                http_response_code(200); // OK
            }

        }

        unset($_POST['command']);

    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
        // Handle file uploads
    
        session_start();
    
        $uploadedFiles = isset($_SESSION['uploadedFiles']) ? $_SESSION['uploadedFiles'] : array();
    
        foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
            $fileName = $_FILES['files']['name'][$index];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = array('pdf');
    
            // Check if the file extension is allowed (PDF)
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadDir = 'uploads/'; // Specify the destination directory
                $uploadPath = $uploadDir . $fileName;
    
                // Check if the upload directory exists, if not, create it
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                // Move the uploaded file to the destination directory
                if (move_uploaded_file($tmpName, $uploadPath)) {
                    $uploadedFiles[] = array(
                        'name' => $fileName,
                        'path' => $uploadPath
                    );
                }
            } else {
                echo "<script>alert('Please upload only PDF files.');</script>";
            }
        }
    
        $_SESSION['uploadedFiles'] = $uploadedFiles;
    
        if (!empty($uploadedFiles)) {
            echo "<ul>";
            foreach ($uploadedFiles as $file) {
                echo "<li style='
                    width: 80%;
                    height: fit-content;
                    padding: 5px 10px 5px 10px;
                    margin: 10px;
                    background-color: #FFFFFF;
                    color: #000000;
                    border-radius: 5px;
                    '>
                    {$file['name']}
                    </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No files uploaded.</p>";
        }
    }
    
?>