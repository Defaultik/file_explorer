<?php
    $file = $_POST["file"];

    if (isset($file)) {
        unlink($file);
    } else {
        http_response_code(400);
    }
?>