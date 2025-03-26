<?php 
include('db.php');
extract($_POST);
// echo $id;
$order_se = mysqli_query($con, "Select * from roombook where id = '$id'");
$res_order = mysqli_fetch_assoc($order_se);
extract($res_order);
$select_room = mysqli_query($con, "SELECT * FROM room where type = '$TRoom' AND bedding='$Bed'");
		// $res_chk = mysqli_num_rows($select_room);
$cus_name = $Title . " " . $FName . " " . $LName;
		$res_room = mysqli_fetch_assoc($select_room);
		$ori_price = $res_room['price'];
		if ($ori_price != "" || $ori_price != null) {

			$price = $ori_price * $nodays * $NRoom * 100;
			// $price = "RM " . $price;
            $o_price = $ori_price * $nodays * $NRoom;
		} else {
			$price = "Price Not Assign";
		}
$some_data = array(
    'userSecretKey'=>'br8wf2p1-hgo5-jltv-x2od-0uxdqedcuity',
    'categoryCode'=>'tduyhagi',
    'billName'=>'Hotel Payment',
    'billDescription'=>'Total Price RM'.$o_price.'',
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>$price,
    'billReturnUrl'=>'http://localhost/hotel/dpay.php?id='.$id.'',
    'billCallbackUrl'=>'http://localhost/hotel/dpay.php?id='.$id.'', // This will not working on localhost
    'billExternalReferenceNo' => '',
    'billTo'=>''.$cus_name.'',
    'billEmail'=>''.$Email.'',
    'billPhone'=>''.$Phone.'',
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'0',
    'billContentEmail'=>'Thank you for purchasing our product!',
    'billChargeToCustomer'=>1
  );  

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = array();
  $result = curl_exec($curl);
//   $info = curl_getinfo($curl);  
$res = json_decode($result, true);
// echo $res[0]["BillCode"];
$code = $res[0]["BillCode"];
// echo $code;
// print_r($res);
header("Location: https://dev.toyyibpay.com/$code");
