<?php 
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,'bus');
    if(isset($_POST['upbp']))
    {
        $pid = $_POST['pid'];
        $usnno = $_POST['usnno'];
        $isdate = $_POST['isdate'];
        $vdate = $_POST['vdate'];
        $fs = $_POST['fs'];
        
        $query1 = "CALL updatebuspassdata('$pid','$usnno','$isdate','$vdate','$fs')";
        $result1 =  mysqli_query($connection,$query1);

        if($result1)
        {
            $_SESSION['success'] = "Updated successfully";
            header("Location: ../adminhome.php");
        }
        else
        {
            $_SESSION['status'] = "Not Updated successfully";

        }
    }
?>