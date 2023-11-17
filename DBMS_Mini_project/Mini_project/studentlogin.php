
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/form.css">
    <title>College Bus Management</title>

</head>
</head>
<body>
    <?php include_once('components/topnavbar.php') ?>


  <?php 
  session_start();
  require_once('methods/connect.php');
  if (isset($_POST['usn']) && isset($_POST['password'])) {
      $uname = $_POST['usn'];
      $pass = $_POST['password'];
      $query = "SELECT * FROM STUDENT WHERE USN = '$uname' and PASSWORD ='$pass'";
      $result = $conn->query($query);
      // if (empty($uname)) {
      //     header("Location: index.php?error=User Name is required");
      //     exit();
      // }else if(empty($pass)){
      //     header("Location: index.php?error=Password is required");
      //     exit();
      // }else{
          if ($result->num_rows > 0) {
              $_SESSION['usn'] = $uname;
              header("Location: userpage.php");
          }
          else{
              // header("Location: connect.php");
                  //header("Location: index.php?error=Incorect User name or password");
      echo "wrong username or password";
              }
          }
  //     }
  // else{
  //     header("Location: ../index.php");
  //     exit();
  // }
  ?>


  <div class="container-sm col-md-6 position-absolute top-50 start-50 translate-middle">
    <h1> Student Login</h1>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <form class="row g-3 w-50"  method="POST">
      <div class="col-12 form-item">
        <label for="inputEmail4" class="form-label">USN</label>
        <input type="text" class="form-control" id="inputEmail4" name="usn" required>
      </div>
      <div class="col-12 form-item">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="password" required>
      </div>     
      <div class="col-12">
        <button type="submit" class="btn btn-warning">Log in</button>
      </div>
    </form>
  </div>

<!-- --------------------Script ------------- -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script

</body>
</html>