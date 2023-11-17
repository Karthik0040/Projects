<?php
require_once('connect.php');

if (isset($_POST['addbtn'])) {
    $coid = $_POST['coid'];
    $coname = $_POST['coname'];
    $cocontact = $_POST['cocontact'];

    $query = "INSERT INTO COORDINATOR(Coordinator_id,Coordinator_name,contact) VALUES ('$coid','$coname','$cocontact')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['success'] = "Added successfully";
        header('Location:../addcoordinator.php');
    } else {
        $_SESSION['status'] = "Not Added successfully";

    }
}
?>