<?php 
    require_once('connect.php');

    if(isset($_POST['addbtn']))
    {
        $busno = $_POST['busno'];
        $cap = $_POST['cap'];
        $rno = $_POST['rno'];
        $coid = $_POST['coid'];
        $drid = $_POST['drid'];

        $query = "INSERT INTO BUS(Bus_no,Driver_id,Coordinator_id,Route_no,Capacity) VALUES ('$busno','$drid','$coid','$rno','$cap')";
        $result =  mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['success'] = "Added successfully";
            header("Location: ../addbus.php");
        }
        else
        {
            $_SESSION['status'] = "Not Added successfully";

        }
    }
?>