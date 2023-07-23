<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/login_panel.css">
        <title>Login</title>
    </head>

    <body>
        <div id="container">
            <h1 id="project_name">login</h1>

            <form action="login/validate.php" method="post">
                <input type="text" class="login_input" placeholder="username" name="username"><br>
                <input type="password" class="login_input" placeholder="password" name="password"><br>
                <input type="submit" value="log in">
            </form>
        </div>
    </body>
</html>