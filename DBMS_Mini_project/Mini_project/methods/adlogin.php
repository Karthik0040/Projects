<?php
session_start();
if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
    $uname = $_POST['inputEmail'];
    $pass = $_POST['inputPassword'];
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        if ($uname == "cbmadmin" && $pass == "332211") {
            $_SESSION['adname'] = "cbmadmin";
            header("Location: ../adminhome.php");
        } else {
            header("Location: index.php?error=Incorect User name or password");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}