<?php
include 'classes/DatabaseInteraction.php';

$db_interaction = new DatabaseInteraction();
if (isset($_POST['password']) && isset($_POST['user'])) {
    $login_successful = $db_interaction->checkLoginData($_POST['user'], $_POST['password']);
    if ($login_successful == true) {
        if (isset($_SESSION)) {
            if ($_SESSION['user'] == $_POST['user']) {
                $_SESSION['login'] = true;
            }
            else {
                session_destroy();
                $_SESSION['login'] = true;
                $_SESSION['user'] = $_POST['user'];
                header("Location: index.php");
            }
        }
        else {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $_POST['user'];
            header("Location: index.php");
        }
    }
    else {
        header("Location: index.php");
    }
}

if (isset($_POST['logout'])) {
    if (session_start()) {
        session_destroy();
    }
}

?>
