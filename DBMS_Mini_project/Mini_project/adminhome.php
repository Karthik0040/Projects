<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/form.css">

  <title>College Bus Management</title>
</head>

<body>
  <div class=" d-flex ">
    <?php require_once('components/sidenavbar.php') ?>

    <!-- Page Content  -->
    <div id="content" class="w-100" style="background-color: #fff;">
      <!-- --------------------scrollspy--------------------------- -->
      <nav id="navbar" class="navbar bg-dark pt-3 px-4 py-0  sticky-top">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <ul class="nav nav-tabs ">
          <li class="nav-item">
            <a class="nav-link px-5 active" id="linktab1" aria-current="page" href="#bustable"
              style="color: gray;">Bus</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-5" id="linktab2" href="#routetable"><span class="links"
                style="color: gray;">Routes</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-5" id="linktab3" href="#studenttable" style="color: gray;">Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-5" id="linktab4" href="#coordinatortable" style="color: gray;">Coordinators</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-5" id="linktab5" href="#drivertable" style="color: gray;">Driver</a>
          </li>
        </ul>
      </nav>

      <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" class="scrollspy-example bg-light p-3 pt-4 rounded-2" tabindex="0"></div>
      <!-- <h2 class="mb-4">ADMIN HOME PAGE</h2> -->
      <?php
      session_start();
      require_once('methods/connect.php');
      $none = "0 results";
      if ($_SESSION['adname'] == null) {
        header('Location:index.php');
      }
      ?>

      <!-- -----------BUS TABLE------------ -->
      <div class="head d-flex justify-content-sm-between mt-6">
        <h4 id="bustable">Bus Entries</h4>
        <a href="addbus.php"><button type="button" class="btn btn-warning me-3"><b>+</b> Add Bus</button></a>
      </div>
      <hr>
      <div class="continer-lg mx-5 ">
        <table class="table  table-striped ">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Bus no</th>
              <th scope="col">Driver id</th>
              <th scope="col">Coordinator</th>
              <th scope="col">Route no</th>
              <th scope="col">Capacity</th>
              <th scope="col">No of students</th>
              <th scope="col">Edit</th>
              <th scope="col">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // require_once('methods/connect.php');
            $query = "select * from BUS";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              // OUTPUT DATA OF EACH ROW
              while ($row3 = mysqli_fetch_assoc($result)) {
                //Route Location join-table 
                echo "<tr><td>" . $row3["Bus_no"];
                echo "<td>" . $row3["Driver_id"] . "</td>";
                echo "<td>" . $row3["Coordinator_id"] . "</td>";
                echo "<td>" . $row3["Route_no"] . "</td>";
                echo "<td>" . $row3["Capacity"] . "</td>";
                echo "<td>" . $row3["No_of_Students"] . "</td>";
                ?>
                <td>
                  <form action="edit.php" method="post">
                    <input type="hidden" name="ed1" value="<?php echo $row3['Bus_no'] ?>">
                    <button type="button" class="btn" name="insert" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class='fa fa-edit' aria-hidden='true'></i></button>

                  </form>
                </td>

                <td>
                  <form action="methods/Delete/delBus.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row3['Bus_no'] ?>">
                    <button type="submit" name="delete" class='btn'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </form>
                </td>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="edit/upbus.php">
                          <div class="row g-3 w-80">
                            <div class="col-sm-12 form-item">
                              <label for="inputbusno" class="form-label">Bus no</label>
                              <input readonly class="textarea form-control" id="inputbusno"
                                value="<?php echo $row3["Bus_no"] ?>" name="busno">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputdid" class="form-label">Driver ID</label>
                              <input type="number" class="textarea form-control" id="inputdid"
                                value="<?php echo $row3["Driver_id"] ?>" name="did">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputcoid" class="form-label">Coordinator ID</label>
                              <input type="number" class="textarea form-control" id="inputcoid"
                                value="<?php echo $row3["Coordinator_id"] ?>" name="coid">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputrno" class="form-label">Route no</label>
                              <input type="number" class="textarea form-control" id="inputrno"
                                value="<?php echo $row3["Route_no"] ?>" name="rno">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputcap" class="form-label">Capacity</label>
                              <input type="number" class="textarea form-control" id="inputcap"
                                value="<?php echo $row3["Capacity"] ?>" name="cap">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputstu" class="form-label">No of Students</label>
                              <input readonly type="number" class="contactus form-control" id="inputstu"
                                value="<?php echo $row3["No_of_Students"] ?>" name="stu">
                            </div>
                          </div>


                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" style="background-color:green" name="upb">Save
                              changes</button><br>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                echo "</tr>";
              }
            } else {
              echo "<tr><td>" . $none . "<td></td><td></td><td></td><td></td></td><td></td><td></td></tr>";
            }
            // $conn->close();
            ?>
          </tbody>
        </table>
      </div>
      <!-- -----------ROUTE TABLE------------ -->
      <div class="head d-flex justify-content-sm-between mt-6">
        <h4 id="routetable">Route Entries</h4>
        <a href="addbusroute.php"><button type="button" class="btn btn-warning me-3"><b>+</b> Add Route</button></a>
      </div>
      <hr>
      <div class="continer-lg mx-5 ">
        <table class="table  table-striped ">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">routeno</th>
              <th scope="col">route</th>
              <th scope="col">Edit</th>
              <th scope="col">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // require_once('methods/connect.php');
            // $none="0 results";
            $query = "select * from `ROUTE`";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              // OUTPUT DATA OF EACH ROW
              while ($row = mysqli_fetch_assoc($result)) {
                //Route Location join-table 
                $x = $row["Route_no"];
                $query1 = "select * from `LOCATION` l where l.Route_no=$x";
                $result1 = $conn->query($query1);
                echo "<tr><td>" . $row["Route_no"] .
                  "</td><td>" . $row["Start_loc"] . " -- ";
                while ($row1 = mysqli_fetch_assoc($result1)) {
                  echo "" . $row1["Loc"] . " -- ";
                }
                echo "" . $row["End_loc"] .
                  "</td>";
                ?>
                <td>
                  <form action="edit.php" method="post">
                    <input type="hidden" name="ed1" value="<?php echo $row['Route_no'] ?>">
                    <button type="button" class="btn" name="insert" data-bs-toggle="modal" data-bs-target="#editroute">
                      <i class='fa fa-edit' aria-hidden='true'></i></button>

                  </form>
                </td>

                <td>
                  <form action="methods/Delete/delRoute.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Route_no'] ?>">
                    <button type="submit" name="delete" class='btn'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </form>
                </td>

                <div class="modal fade" id="editroute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="methods/routeadd.php">
                          <div class="row g-3 w-80">
                            <div class="col-sm-12 form-item">
                              <label for="inputrrouteno" class="form-label">Route No</label>
                              <input type="text" class="contactus form-control" id="inputrouteno" placeholder="Route No"
                                name="routeno" required>
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputstartloc" class="form-label">Starting Point</label>
                              <input type="text" class="textarea form-control" id="inputcapacity" placeholder="Start Point"
                                name="startloc" required>
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputendloc" class="form-label">End Location</label>
                              <input type="text" class="contactus form-control" id="inputendloc" placeholder="End Point"
                                name="endloc" required>
                            </div>
                            <!------------ intermediate stops ------------->
                            <?php
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                              echo "" . $row["End_loc"] . "";
                              echo "" . $row1["Loc"] . "--->";
                            }
                            ?>
                          </div>
                          <div class="col-md-2 py-3 additembtn btn btn-outline-warning d-grid" style="width:auto;">
                            <p style="margin:0;">+</p>
                          </div>
                      </div>
                      <div class="col-sm-12 buttons">
                        <button class="send btn btn-warning" name="addbtn">Add</button><br><br>
                        <a href="adminhome.php "><button class="send btn btn-outline-warning">See List</button></a>
                      </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <?php
                      echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                      echo '<button type="button" class="btn btn-primary" name="editbtn" onclick="savechanges($row["Driver_id"])">Save changes</button>';
                      ?>
                    </div>
                  </div>
                  <!-- </div> -->
                </div>

                <?php
                echo "</tr>";
              }
            } else {
              echo "<tr><td>" . $none . "</td><td></td><td></td></tr>";
            }
            // $conn->close();
            ?>
          </tbody>
        </table>
      </div>
      <!-- --------------STUDENT TABLE------------- -->
      <div class="head d-flex justify-content-sm-between mt-6">
        <h4 id="studenttable">Student Entries</h4>
        <a href="addstudent.php"><button type="button" class="btn btn-warning me-3"><b>+</b> Add Student</button></a>
      </div>
      <hr>
      <div class="continer-lg mx-5 ">
        <table class="table  table-striped ">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">USN</th>
              <th scope="col">Namw</th>
              <th scope="col">Bus no</th>
              <th scope="col">Address</th>
              <th scope="col">Contact</th>
              <th scope="col">Gender</th>
              <th scope="col">password</th>
              <th scope="col">Edit</th>
              <th scope="col">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // require_once('methods/connect.php');
            $query1 = "select * from STUDENT";
            $result1 = $conn->query($query1);
            if ($result1->num_rows > 0) {
              // OUTPUT DATA OF EACH ROW
              while ($row4 = mysqli_fetch_assoc($result1)) {
                //Route Location join-table 
                echo "<tr><td>" . $row4["USN"];
                echo "<td>" . $row4["Name"] . "</td>";
                echo "<td>" . $row4["Bus_no"] . "</td>";
                echo "<td>" . $row4["Address"] . "</td>";
                echo "<td>" . $row4["Contact"] . "</td>";
                echo "<td>" . $row4["Gender"] . "</td>";
                echo "<td>" . $row4["Password"] . "</td>";
                ?>
                <td>
                  <form action="edit/upstudent.php" method="post">
                    <input type="hidden" name="ed1" value="<?php echo $row4['USN'] ?>">
                    <button type="button" class="btn" name="insert" data-bs-toggle="modal" data-bs-target="#studentedit">
                      <i class='fa fa-edit' aria-hidden='true'></i></button>

                  </form>
                </td>

                <td>
                  <form action="methods/Delete/delStudent.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row4['USN'] ?>">
                    <input type="hidden" name="i" value="<?php echo $row4['Bus_no'] ?>">
                    <button type="submit" name="delete" class='btn'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </form>
                </td>

                <div class="modal fade" id="studentedit" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT STUDENT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="edit/upstudent.php">
                          <div class="row g-3 w-80">
                            <div class="col-sm-12 form-item">
                              <label for="inputusn" class="form-label">USN</label>
                              <input readonly class="textarea form-control" id="inputusn" value="<?php echo $row4["USN"] ?>"
                                name="usnno">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputname" class="form-label">Name</label>
                              <input type="text" class="textarea form-control" id="inputname"
                                value="<?php echo $row4["Name"] ?>" name="name">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputbusno" class="form-label">Bus_no</label>
                              <input type="number" class="textarea form-control" id="inputbusno"
                                value="<?php echo $row4["Bus_no"] ?>" name="busno">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputads" class="form-label">Address</label>
                              <input type="text" class="textarea form-control" id="inputads"
                                value="<?php echo $row4["Address"] ?>" name="ads">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputg" class="form-label">Gender</label>
                              <input type="text" class="textarea form-control" id="inputg"
                                value="<?php echo $row4["Gender"] ?>" name="gender">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputpword" class="form-label">Password</label>
                              <input type="text" class="textarea form-control" id="inputpword"
                                value="<?php echo $row4["Password"] ?>" name="pword">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputcon" class="form-label">Contact</label>
                              <input type="text" class="contactus form-control" id="inputcon"
                                value="<?php echo $row4["Contact"] ?>" name="con">
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" style="background-color:green" name="upstu">Save
                              changes</button><br>
                          </div>
                        </form>
                      </div>
                    </div>

                    <?php
                    echo "</td></tr>";
              }
            } else {
              echo "<tr><td>" . $none . "<td></td><td></td><td></td><td></td><td></td></td><td></td><td></td></tr>";
            }
            // $conn->close();
            ?>
          </tbody>
        </table>
      </div>
      <!----------- COORDINATOR TABLE ------------>
      <div class="head d-flex justify-content-sm-between mt-6">
        <h4 id="coordinatortable">Coordinator Entries</h4>
        <a href="addcoordinator.php"><button type="button" class="btn btn-warning me-3"><b>+</b> Add
            Coordinator</button></a>
      </div>
      <hr>
      <div class="continer-lg mx-5 ">
        <table class="table  table-striped ">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Coordinator ID</th>
              <th scope="col">Coordinator name</th>
              <th scope="col">Contacts</th>
              <th scope="col">Edit</th>
              <th scope="col">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // require_once('methods/connect.php');
            $query = "select * from COORDINATOR";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              // OUTPUT DATA OF EACH ROW
              while ($row2 = mysqli_fetch_assoc($result)) {
                //Route Location join-table 
                echo "<tr><td>" . $row2["Coordinator_id"];
                echo "<td>" . $row2["Coordinator_name"] . "</td>";
                echo "<td>" . $row2["contact"] . "</td>";
                ?>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="ed1" value="<?php echo $row2['Coordinator_id'] ?>">
                    <button type="button" class="btn" name="insert" data-bs-toggle="modal"
                      data-bs-target="#coordinatoredit">
                      <i class='fa fa-edit' aria-hidden='true'></i></button>
                  </form>
                </td>

                <td>
                  <form action="methods/Delete/delCoor.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row2['Coordinator_id'] ?>">
                    <button type="submit" name="delete" class='btn'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </form>
                </td>

                <div class="modal fade" id="coordinatoredit" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT STUDENT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="edit/upcoordinator.php">
                          <div class="row g-3 w-80">
                            <div class="col-sm-12 form-item">
                              <label for="inputcoid" class="form-label">Coordintor ID</label>
                              <input readonly class="textarea form-control" id="inputcoid"
                                value="<?php echo $row2["Coordinator_id"] ?>" name="cid">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputconame" class="form-label">Coordinator Name</label>
                              <input type="text" class="textarea form-control" id="inputconame"
                                value="<?php echo $row2["Coordinator_name"] ?>" name="coname">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputcocontact" class="form-label">Coordinator Contact</label>
                              <input type="text" class="contactus form-control" id="inputcocontact"
                                value="<?php echo $row2["contact"] ?>" name="cocontact">
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" style="background-color:green" name="upco">Save
                              changes</button><br>
                          </div>
                        </form>
                      </div>
                    </div>


                    <?php
                    echo "</td></tr>";
              }
            } else {
              echo "<tr><td>" . $none . "</td><td></td><td></td><td></td></tr>";
            }
            // $conn->close();
            ?>
          </tbody>
        </table>
      </div>
      <!----------- DRIVER TABLE ------------>
      <div class="head d-flex justify-content-sm-between mt-6">
        <h4 id="drivertable">Driver Entries</h4>
        <a href="adddriver.php"><button type="button" class="btn btn-warning me-3"><b>+</b> Add Driver</button></a>
      </div>
      <hr>
      <div class="continer-lg mx-5" id="drivertable">
        <table class="table  table-striped">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Driver ID</th>
              <th scope="col">Driver name</th>
              <th scope="col">Contacts</th>
              <th scope="col">Edit</th>
              <th scope="col">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "select * from DRIVER";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              // OUTPUT DATA OF EACH ROW
              while ($row = mysqli_fetch_assoc($result)) {
                //Route Location join-table 
                $x = $row["Driver_id"];
                echo "<tr><td>" . $row["Driver_id"];
                echo "<td>" . $row["Driver_name"] . "</td>";
                echo "<td>" . $row["Driver_contact"] . "</td>
                    <td>";
                ?>
                <form action="" method="post">
                  <input type="hidden" name="ed1" value="<?php echo $row['Driver_id'] ?>">
                  <button type="button" class="btn" name="insert" data-bs-toggle="modal" data-bs-target="#driveredit">
                    <i class='fa fa-edit' aria-hidden='true'></i></button>
                </form>
                </td>

                <td>
                  <form action="methods/Delete/delDriver.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Driver_id'] ?>">
                    <button type="submit" name="delete" class='btn'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </form>
                </td>

                <div class="modal fade" id="driveredit" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="edit/updriver.php">
                          <div class="row g-3 w-80">
                            <div class="col-sm-12 form-item">
                              <label for="inputdrid" class="form-label">Driver ID</label>
                              <input readonly class="textarea form-control" id="inputdrid"
                                value="<?php echo $row["Driver_id"] ?>" name="did">
                            </div>
                            <div class="col-sm-12 form-item">=
                              <label for="inputdrname" class="form-label">Driver Name</label>
                              <input type="text" class="textarea form-control" id="inputdrname"
                                value="<?php echo $row["Driver_name"] ?>" name="drname">
                            </div>
                            <div class="col-sm-12 form-item">
                              <label for="inputdrcontact" class="form-label">Driver Contact</label>
                              <input type="text" class="contactus form-control" id="inputdrcontact"
                                value="<?php echo $row["Driver_contact"] ?>" name="drcontact">
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" style="background-color:green" name="updr">Save
                              changes</button><br>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                echo "</tr>";
              }
            } else {
              echo "<tr><td>" . $none . "</td><td></td><td></td><td></td><td></td></tr>";
            }
            ?>
          </tbody>
        </table>


        <?php echo '<button onclick="window.print()" class="btn btn-warning m-5">Print</button>'; ?>
      </div>
      <?php $conn->close(); ?>
    </div>
  </div>

  <!-- ------------Script------------- -->
  <script>
    const linktab1 = document.getElementById('linktab1');
    const linktab2 = document.getElementById('linktab2');
    const linktab3 = document.getElementById('linktab3');
    const linktab4 = document.getElementById('linktab4');
    const linktab5 = document.getElementById('linktab5');
    linktab1.addEventListener('click', function () {
      linktab1.classList.add('active');
      linktab2.classList.remove('active');
      linktab3.classList.remove('active');
      linktab4.classList.remove('active');
      linktab5.classList.remove('active');
    })
    linktab2.addEventListener('click', function () {
      linktab1.classList.remove('active');
      linktab2.classList.add('active');
      linktab3.classList.remove('active');
      linktab4.classList.remove('active');
      linktab5.classList.remove('active');
    })
    linktab3.addEventListener('click', function () {
      linktab1.classList.remove('active');
      linktab2.classList.remove('active');
      linktab3.classList.add('active');
      linktab4.classList.remove('active');
      linktab5.classList.remove('active');
    })
    linktab4.addEventListener('click', function () {
      linktab1.classList.remove('active');
      linktab2.classList.remove('active');
      linktab3.classList.remove('active');
      linktab4.classList.add('active');
      linktab5.classList.remove('active');
    })
    linktab5.addEventListener('click', function () {
      linktab1.classList.remove('active');
      linktab2.classList.remove('active');
      linktab3.classList.remove('active');
      linktab4.classList.remove('active');
      linktab5.classList.add('active');
    })

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>