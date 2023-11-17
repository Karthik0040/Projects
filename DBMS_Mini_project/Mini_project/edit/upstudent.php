<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'bus');
if (isset($_POST['upstu'])) {
    $usnno = $_POST['usnno'];
    $name = $_POST['name'];
    $busno = $_POST['busno'];
    $ads = $_POST['ads'];
    $con = $_POST['con'];
    $gender = $_POST['gender'];
    $pword = $_POST['pword'];

    $query1 = "CALL updatestudentdata('$usnno','$name','$busno','$ads','$con','$gender','$pword')";
    $result1 = mysqli_query($connection, $query1);

    if ($result1) {
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../adminhome.php");
    } else {
        $_SESSION['status'] = "Not Updated successfully";

    }
}
?>