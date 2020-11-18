<?php
session_start();
    echo '<html><head><link rel="stylesheet" href="assets/css/main.css"></head>
    <body><div class="container"><form action="" method="post">';
    if (isset($_SESSION['loggedin']))
    {
        header('Location: profile.php');

    }
    else
    {
        print <<<_HTML_
Your Name: <input type="text" name="user" />
Your password: <input type="password" name="password" />
<br>
<button class="but" type="submit">Sign in</button>
_HTML_;
    }
    require_once 'inc/sign_in.php';
    echo '</form><button class="but" ><a href="Index.php">Main</a></button></div></body></html>';

