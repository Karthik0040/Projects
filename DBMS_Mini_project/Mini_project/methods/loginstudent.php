<?php
session_start();
require_once('connect.php');
if (isset($_POST['usn']) && isset($_POST['password'])) {
    $uname = $_POST['usn'];
    $pass = $_POST['password'];
    $query = "SELECT * FROM STUDENT WHERE USN = '$uname' and PASSWORD ='$pass'";
    $result = $conn->query($query);
    // if (empty($uname)) {
    //     header("Location: index.php?error=User Name is required");
    //     exit();
    // }else if(empty($pass)){
    //     header("Location: index.php?error=Password is required");
    //     exit();
    // }else{
    if ($result->num_rows > 0) {
        $_SESSION['usn'] = $uname;
        header("Location: ../userpage.php");
    } else {
        // header("Location: connect.php");
        //header("Location: index.php?error=Incorect User name or password");
        exit();
    }
}
//     }
else {
    header("Location: ../index.php");
    exit();
}