<?php
// print_r($_POST);
// require_once('connect.php');
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "Bus_management";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}

if (isset($_POST['addbtn'])) {
    $routeno = $_POST['routeno'];
    $startloc = $_POST['startloc'];
    $endloc = $_POST['endloc'];
    // $i=0;
    // while($rows){
    //     $save = "INSERT INTO LOCATION(Route_no,Loc)VALUES('$routeno','".$_POST['pickuppoint'+$i]."')";
    //     $q = mysqli_query($conn,$save);
    //     $i += 1;
    // }

    $query = "INSERT INTO ROUTE(Route_no,Start_loc,End_loc) VALUES ('$routeno','$startloc','$endloc')";
    $result = mysqli_query($conn, $query);



    foreach ($_POST['pickuppoint'] as $element) {
        // Escape any special characters in the form data
        $name = $element;
        // $name = $conn->real_escape_string($element['pickuppoint']);

        // Construct the query
        $query1 = "INSERT INTO LOCATION (Route_no , Loc) VALUES ('$routeno', '$name')";

        // Execute the query
        $result1 = $conn->query($query1);

        if (!$result1) {
            die('Error: ' . $conn->error);
        }
    }
    if ($result) {
        $_SESSION['success'] = "Added successfully";
        header("Location: ../addbusroute.php");
    } else {
        $_SESSION['status'] = "Not Added successfully";
        // header("Location: connect.php");
    }

}
?>