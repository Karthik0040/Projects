<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'bus');
if (isset($_POST['upb'])) {
    $busno = $_POST['busno'];
    $did = $_POST['did'];
    $cap = $_POST['cap'];
    $coid = $_POST['coid'];
    $rno = $_POST['rno'];
    $stu = $_POST['stu'];
    echo "hello";

    $query1 = "CALL updatebusdata('$busno','$did','$coid','$rno','$cap','$stu')";
    $result1 = mysqli_query($connection, $query1);

    if ($result1) {
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../adminhome.php");
    } else {
        $_SESSION['status'] = "Not Updated successfully";

    }
}
?>