<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("location:index.php");
}
?>

<?php
if (!isset($_GET["rid"])) {

	header("location:index.php");
} else {
	$curdate = date("Y/m/d");
	include('db.php');
	$id = $_GET['rid'];


	$sql = "Select * from roombook where id = '$id'";
	$re = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($re)) {
		$title = $row['Title'];
		$fname = $row['FName'];
		$lname = $row['LName'];
		$email = $row['Email'];
		$nat = $row['National'];
		$country = $row['Country'];
		$Phone = $row['Phone'];
		$troom = $row['TRoom'];
		$nroom = $row['NRoom'];
		$bed = $row['Bed'];
		$non = $row['NRoom'];
		$meal = $row['Meal'];
		$cin = $row['cin'];
		$cout = $row['cout'];
		$sta = $row['stat'];
		$days = $row['nodays'];

		$select_room = mysqli_query($con, "SELECT * FROM room where type = '$troom' AND bedding='$bed'");
		// $res_chk = mysqli_num_rows($select_room);

		$res_room = mysqli_fetch_assoc($select_room);
		$ori_price = $res_room['price'];
		if ($ori_price != "" || $ori_price != null) {

			$price = $ori_price * $days * $nroom;
			$price = "RM " . $price;
		} else {
			$price = "Price Not Assign";
		}
	}
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Administrator </title>
	<!-- Bootstrap Styles-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FontAwesome Styles-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- Morris Chart Styles-->
	<link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<!-- Custom Styles-->
	<link href="assets/css/custom-styles.css" rel="stylesheet" />
	<!-- Google Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>








			</ul>

		</div>

	</nav>
	<!-- /. NAV SIDE  -->




	<div id="page-wrapper">
		<div id="page-inner">


			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">
						Customer Booking Confirmation<small> <?php echo  $curdate; ?> </small>
					</h1>
				</div>

				
				<div class="col-md-8 col-sm-8">
					<div class="panel panel-info">
						<div class="panel-heading">
							Booking Confirmation
						</div>
						<div class="panel-body">

							<div class="table-responsive">
								<table class="table">
									<tr>
										
										<th>INFORMATION</th>

									</tr>
									<tr>
										<th>Name</th>
										<th><?php echo $title . " " . $fname . " " . $lname; ?> </th>

									</tr>
									<tr>
										<th>Email</th>
										<th><?php echo $email; ?> </th>

									</tr>
									<tr>
										<th>Nationality </th>
										<th><?php echo $nat; ?></th>

									</tr>
									<tr>
										<th>Country </th>
										<th><?php echo $country;  ?></th>

									</tr>
									<tr>
										<th>Phone No </th>
										<th><?php echo $Phone; ?></th>

									</tr>
									<tr>
										<th>Room Type </th>
										<th><?php echo $troom; ?></th>

									</tr>
									<tr>
										<th>Total Room</th>
										<th><?php echo $nroom; ?></th>

									</tr>
									<tr>
										<th>Meal Plan </th>
										<th><?php echo $meal; ?></th>

									</tr>
									<tr>
										<th>Bed Type </th>
										<th><?php echo $bed; ?></th>

									</tr>
									<tr>
										<th>Check-in Date </th>
										<th><?php echo $cin; ?></th>

									</tr>
									<tr>
										<th>Check-out Date</th>
										<th><?php echo $cout; ?></th>

									</tr>
									<tr>
										<th>No of days</th>
										<th><?php echo $days; ?></th>

									</tr>
									<tr>
										<th>Status Level</th>
										<th><?php echo $sta; ?></th>

									</tr>
									<tr>
										<th>Total</th>
										<th><?php echo $price; ?></th>

									</tr>
									<form method="post" action="checkout.php">
							<input type="hidden" name="id" value="<?php echo $id; ?>" />



								</table>
							</div>



						</div>
						<div class="panel-footer">
							
								<input type="submit" name="co" value="Submit" class="btn btn-success">

							</form>
						</div>
					</div>
				</div>

				<?php
				$rsql = "select * from room";
				$rre = mysqli_query($con, $rsql);
				$r = 0;
				$sc = 0;
				$gh = 0;
				$sr = 0;
				$dr = 0;
				while ($rrow = mysqli_fetch_array($rre)) {
					$r = $r + 1;
					$s = $rrow['type'];
					$p = $rrow['place'];
					if ($s == "Grand Deluxe Ro") {
						$sc = $sc + 1;
					}

					if ($s == "King Deluxe Roo") {
						$gh = $gh + 1;
					}
					if ($s == "Classic Room") {
						$sr = $sr + 1;
					}
				}
				?>

				<?php
				$csql = "select * from payment";
				$cre = mysqli_query($con, $csql);
				$cr = 0;
				$csc = 0;
				$cgh = 0;
				$csr = 0;
				$cdr = 0;
				while ($crow = mysqli_fetch_array($cre)) {
					$cr = $cr + 1;
					$cs = $crow['troom'];

					if ($cs == "Grand Deluxe Ro") {
						$csc = $csc + 1;
					}

					if ($cs == "King Deluxe Roo") {
						$cgh = $cgh + 1;
					}
					if ($cs == "Classic Room") {
						$csr = $csr + 1;
					}
				}

				?>
				<div class="col-md-4 col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Available Room Details
						</div>
						<div class="panel-body">
							<table width="200px">

								<tr>
									<td><b>Grand Deluxe Room </b></td>
									<td><button type="button" class="btn btn-primary btn-circle"><?php
																									$f1 = $sc - $csc;
																									if ($f1 <= 0) {
																										$f1 = "NO";
																										echo $f1;
																									} else {
																										echo $f1;
																									}


																									?> </button></td>
								</tr>
								<tr>
									<td><b>King Deluxe Room</b> </td>
									<td><button type="button" class="btn btn-primary btn-circle"><?php
																									$f2 =  $gh - $cgh;
																									if ($f2 <= 0) {
																										$f2 = "NO";
																										echo $f2;
																									} else {
																										echo $f2;
																									}

																									?> </button></td>
								</tr>
								<tr>
									<td><b>Classic Room</b></td>
									<td><button type="button" class="btn btn-primary btn-circle"><?php
																									$f3 = $sr - $csr;
																									if ($f3 <= 0) {
																										$f3 = "NO";
																										echo $f3;
																									} else {
																										echo $f3;
																									}

																									?> </button></td>
								</tr>

								<tr>

								</tr>
							</table>





						</div>
						<div class="panel-footer">

						</div>
					</div>
				</div>
			</div>
			<!-- /. ROW  -->

		</div>
		<!-- /. ROW  -->




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
	<!-- Morris Chart Js -->
	<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
	<script src="assets/js/morris/morris.js"></script>
	<!-- Custom Js -->
	<script src="assets/js/custom-scripts.js"></script>


</body>

</html>

<?php
if (isset($_POST['co'])) {
	$st = $_POST['conf'];



	if ($st == "Confirm") {
		$urb = "UPDATE `roombook` SET `stat`='$st' WHERE id = '$id'";

		if ($f1 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Superior Room ')</script>";
		} else if ($f2 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Guest House')</script>";
		} else if ($f3 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Single Room')</script>";
		} else if ($f4 == "NO") {
			echo "<script type='text/javascript'> alert('Sorry! Not Available Deluxe Room')</script>";
		} else if (mysqli_query($con, $urb)) {
			//echo "<script type='text/javascript'> alert('Guest Room booking is confirm')</script>";
			//echo "<script type='text/javascript'> window.location='home.php'</script>";
			$type_of_room = 0;
			if ($troom == "Grand Deluxe Room") {
				$type_of_room = 250;
			} else if ($troom == "King Deluxe Room") {
				$type_of_room = 180;
			} else if ($troom == "Classic Room") {
				$type_of_room = 150;
			}





			if ($bed == "Single") {
				$type_of_bed = $type_of_room * 1 / 100;
			} else if ($bed == "Double") {
				$type_of_bed = $type_of_room * 2 / 100;
			} else if ($bed == "Triple") {
				$type_of_bed = $type_of_room * 3 / 100;
			}



			if ($meal == "Room only") {
				$type_of_meal = $type_of_bed * 0;
			} else if ($meal == "Breakfast") {
				$type_of_meal = $type_of_bed * 2;
			} else if ($meal == "Half Board") {
				$type_of_meal = $type_of_bed * 3;
			} else if ($meal == "Full Board") {
				$type_of_meal = $type_of_bed * 4;
			}


			$ttot = $type_of_room * $days * $nroom;
			$mepr = $type_of_meal * $days;
			$btot = $type_of_bed * $days;

			$fintot = $ttot + $mepr + $btot;

			//echo "<script type='text/javascript'> alert('$count_date')</script>";
			$psql = "INSERT INTO `payment`(`id`, `title`, `fname`, `lname`, `troom`, `tbed`, `nroom`, `cin`, `cout`, `ttot`,`meal`, `mepr`, `btot`,`fintot`,`noofdays`) VALUES ('$id','$title','$fname','$lname','$troom','$bed','$nroom','$cin','$cout','$ttot','$meal','$mepr','$btot','$fintot','$days')";

			if (mysqli_query($con, $psql)) {
				$notfree = "Occupied";
				$rpsql = "UPDATE `room` SET `place`='$notfree',`cusid`='$id' where bedding ='$bed' and type='$troom' ";
				if (mysqli_query($con, $rpsql)) {
					echo "<script type='text/javascript'> alert('Booking Confirm')</script>";
					echo "<script type='text/javascript'> window.location='roombook.php'</script>";
				}
			}
		}
	}
}




?>