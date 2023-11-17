<?php 
    require_once('connect.php');

    if(isset($_POST['addbtn']))
    {
        $drid = $_POST['drid'];
        $drname = $_POST['drname'];
        $drcontact = $_POST['drcontact'];

        $query = "INSERT INTO DRIVER(Driver_id,Driver_name,Driver_contact) VALUES ('$drid','$drname','$drcontact')";
        $result =  mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['success'] = "Added successfully";
            header('Location: ../adddriver.php');
        }
        else
        {
            $_SESSION['status'] = "Not Added successfully";
            header('Location: ../adddriver.php');

        }
    }
?>