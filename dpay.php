<?php
include('db.php');
extract($_GET);
$query_update = mysqli_query($con, "UPDATE roombook set stat = 'Confirm' where id = '$id'");
if($query_update){
 
    echo "<script type='text/javascript'> window.location='admin/bookingcompleted.html?rid=$last_id'</script>";
}else{
    echo $con;
}
?>