<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'bus');
if (isset($_POST['updr'])) {
    $dname = $_POST['drname'];
    $dcontact = $_POST['drcontact'];
    $did = $_POST['did'];

    $query = "CALL updatedriverdata('$did','$dname','$dcontact')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../adminhome.php");
    } else {
        $_SESSION['status'] = "Not Updated successfully";

    }
}
?>