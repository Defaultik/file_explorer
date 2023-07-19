<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>File Explorer</title>
    </head>

    <body>
        <h1 id="project_name">Simple File Explorer</h1>

        <?php
            echo "<h4 id='current_directory'>file_explorer/" . $_GET["dir"] . "</h4>";
        ?>

        <?php
            if (isset($_GET["dir"]) !== true) {
                header("Location: /file_explorer/?dir=");
            }

            $dir = "C:/xampp/htdocs/file_explorer/" . $_GET["dir"];
            $files = array_diff(scandir($dir), array(".", ".."));

            echo "<div id='container'>";
            echo "<button id='back_button' type='button' onclick='history.go(-1)'>Back</button>";
                foreach($files as $file) {
                    echo "<div class='box'>";

                    if (is_dir($file)) {
                        echo "<img class='folder_icon' src='http://localhost/file_explorer/img/rsz_folder.png'>"; 
                        echo "<a class='folder_link' href='?dir=" . $file . "'>" . $file . "</a>";
                    } else {
                        echo "<img class='file_icon' src='http://localhost/file_explorer/img/rsz_file.png'>";

                        if (empty($_GET["dir"])) {
                            echo "<a class='file_link' href=" . $file . ">" . $file . "</a>";
                        } else {
                            echo "<a class='file_link' href=" . $_GET["dir"] . "/" . $file . ">" . $file . "</a>";
                        }

                        echo "<p class='file_size'>" . formatSizeUnits(filesize($dir . "/" . $file)) . "</p>";
                        echo "<button class='edit_button'><img src=img/rsz_more.png></button>";
                    }

                    echo "</div>";
                }
            echo "</div>";
            
            function formatSizeUnits($bytes) {
                if ($bytes >= 1073741824) {
                    $bytes = number_format($bytes / 1073741824, 2) . " GB";
                } elseif ($bytes >= 1048576) {
                    $bytes = number_format($bytes / 1048576, 2) . " MB";
                } elseif ($bytes >= 1024) {
                    $bytes = number_format($bytes / 1024, 2) . " KB";
                } elseif ($bytes > 1) {
                    $bytes = $bytes . " bytes";
                } elseif ($bytes == 1) {
                    $bytes = $bytes . " byte";
                } else {
                    $bytes = "0 bytes";
                }

                return $bytes;
            }
        ?>
    </body>
</html>