<?php 
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,'bus');
    if(isset($_POST['upco']))
    {
        $cname = $_POST['coname'];
        $ccontact = $_POST['cocontact'];
        $cid = $_POST['cid'];
        
        $query1 = "CALL updatecoordinatordata('$cid','$cname','$ccontact')";
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