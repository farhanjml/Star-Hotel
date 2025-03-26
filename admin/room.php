<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Rooms</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>


    <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="home.php">MAIN MENU </a></li>
                <li class="divider"></li>
                <li>

                    <a href="room.php"><i class="fa fa-plus-circle"></i> Add Room</a>
                </li>
                <li>
                    <a href="roomdel.php"><i class="fa fa-desktop"></i> Delete Room</a>
                </li>
                <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>

                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>

            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    </nav>



    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">

                </div>
            </div>


            <div class="ro">

                <div class="col-md-5 cl-sm-5">
                    <div class="">
                        <div class="panel-heading">
                            <h3> Add Rooms </h3>
                        </div>
                        <div class="panel-body">
                            <form name="form" method="post">
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <select name="troom" class="form-control" required>
                                        <option value selected></option>
                                        <option value="Grand Deluxe Room">Grand Deluxe Room</option>
                                        <option value="King Deluxe Room">King Deluxe Room</option>
                                        <option value="Classic Room">Classic Room</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Bed Type</label>
                                    <select name="bed" class="form-control" required>
                                        <option value selected></option>
                                        <option value="Single">Single</option>
                                        <option value="Double">Double</option>
                                        <option value="Triple">Triple</option>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control" />
                                </div>

                                <input type="submit" name="add" value="Submit" class="btn btn-primary">
                            </form>
                            <?php
                            include('db.php');
                            if (isset($_POST['add'])) {
                                $room = $_POST['troom'];
                                $bed = $_POST['bed'];
                                $price = $_POST['price'];
                                $place = 'Not Occupied';

                                $check = "SELECT * FROM room WHERE type = '$room' AND bedding = '$bed'";
                                $rs = mysqli_query($con, $check);
                                // $data = mysqli_fetch_array($rs, MYSQLI_NUM);
                                $data = mysqli_num_rows($rs);
                                if ($data != 0 ) {
                                    echo "<script type='text/javascript'> alert('Room Already in Exists')</script>";
                                } else {


                                    $sql = "INSERT INTO `room`( `type`, `bedding`,`place`,`price`) VALUES ('$room','$bed','$place','$price')";
                                    if (mysqli_query($con, $sql)) {
                                        echo '<script>alert("Selected Room has been succesfully added") </script>';
                                    } else {
                                        echo '<script>alert("Sorry ! Check The System") </script>';
                                    }
                                }
                            }

                            ?>
                        </div>

                    </div>
                </div>


                <div class="ro">
                    <div class="col-md-6 col-sm-6">
                        <div class="    ">
                            <div class="panel-heading">
                                <h3>Room Information</h3>
                            </div>
                            <div class="panel-body">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">
                                    <?php
                                    $sql = "select * from room limit 0,10";
                                    $re = mysqli_query($con, $sql)
                                    ?>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Room Type</th>
                                                        <th>Bed Type</th>
                                                        <th>Pricing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    while ($row = mysqli_fetch_array($re)) {
                                                        $id = $row['id'];
                                                        if($row['price'] != "" || $row['price'] != null){
                                                            $price = "RM " . $row['price'];
                                                        }else{
                                                            $price = "";
                                                        }
                                                        if ($id % 2 == 0) {
                                                            echo "<tr class=odd gradeX>
													<td>" . $row['id'] . "</td>
													<td>" . $row['type'] . "</td>
												   <th>" . $row['bedding'] . "</th>
                                                   <th>" . $price . "</th>
												</tr>";
                                                        } else {
                                                            echo "<tr class=even gradeC>
													<td>" . $row['id'] . "</td>
													<td>" . $row['type'] . "</td>
												   <th>" . $row['bedding'] . "</th>
                                                   <th>" . $price . "</th>
												</tr>";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!--End Advanced Tables -->









                            </div>

                        </div>
                    </div>


                </div>



            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>