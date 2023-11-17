<?php 
    require_once('connect.php');

    if(isset($_POST['reg']))
    {
        $usn_no = $_POST['usno'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $phone=$_POST['phone'];
        $address = $_POST['stopname'];
        $busno = $_POST['busnumber'];
        $password='12345678';

        $query = "INSERT INTO STUDENT(USN,Name,Bus_no,Address,Contact,Gender,Password) VALUES ('$usn_no','$name','$busno','$address','$phone','$gender','$password')";
        $check = "SELECT * FROM STUDENT WHERE USN = '$usn_no'";
        $checkres = mysqli_query($conn,$check);
        if(mysqli_num_rows($checkres))
        {
            echo "<script>alert('This USN:`$usn_no` is already registered.')</script>";
            // header("Location: ../addstudent.php");
        }
        else
        {
            $result =  mysqli_query($conn,$query);
            $Q="UPDATE BUS set No_of_Students=No_of_Students+1 where Bus_no='$busno'";
            $result1 =  mysqli_query($conn,$Q);
        }

        if($result)
        {
            $_SESSION['success'] = "Added successfully";
            header("Location: ../addstudent.php");

        }
        else
        {
            $_SESSION['status'] = "Not Added successfully";
            header("Location: ../addstudent.php");
        }
    }
?>