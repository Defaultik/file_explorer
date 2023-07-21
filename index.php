<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>File Explorer</title>
    </head>

    <body>
        <!-- 
            TODO:
                    deletion-confirm menu
                    rename function
                    to do my own sort-files mechanic
                    to do white effect on the background of list
                    redesign header
                    redesign 'Back' button
         -->

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

            foreach ($files as $file) {
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

                    echo "<p class='file_size'>" . size_units(filesize($dir . "/" . $file)) . "</p>";
                }
                
                $file_func = "'" . $file . "'";
                $file_func = htmlspecialchars($file_func);

                echo "<button onclick='open_dropdown($file_func)' class='file_manage_button' type='button'>";
                echo "<img src=img/rsz_more.png>";
                echo "</button>";

                echo "<div onclick='file_delete($file_func)' data-type='delete_" . $file . "' id='dropdown_links'>";
                echo "<img src=img/rsz_bin.png>";
                echo "</div>";

                echo "</div>";
            }

            echo "</div>";
        ?>

       <script>
            function open_dropdown(file) {
                var file_name = "delete_" + file
                var specific_file = document.querySelector("[data-type='" + file_name + "']");

                // if (specific_file.style.display === "none") { // buggy, works only on second click
                if (window.getComputedStyle(specific_file, null).getPropertyValue("display") === 'none') {
                    specific_file.style.display = "flex";
                } else {
                    specific_file.style.display = "none";
                }
            }

            function file_delete(file) {
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "file_delete.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("file=" + encodeURIComponent(file));

                location.reload()
            }
        </script>

        <?php
            function size_units($bytes) {
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