<?php

$my_array = array('admin'=>'password','log'=>'123');
if (isset($my_array[$_POST['user']]) && $my_array[$_POST['user']] == $_POST['password'])
    {
        $_SESSION['loggedin'] = $_POST['user'];
        header('Location: profile.php');
    }
else if (!empty($_POST['user']) && !array_key_exists($_POST['user'],$my_array))
    {
            echo '<br><div class="msg">Нет логина в системе!</div>';

    }
else if ( $my_array[$_POST['user']] != $_POST['password'])
    {
        echo '<br><div class="msg">Пароль неверный!</div>';
    }
else if (!empty($_POST['subm']) && $_POST['subm'] == "Logout")
    {
        unset($_SESSION['loggedin']);
        session_destroy();
    }



