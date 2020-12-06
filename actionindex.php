<?php
session_start();

	$pickup=$_POST['pickup'];
	$drop=$_POST['drop'];
	$cabtype=$_POST['cabtype'];
	
$_SESSION['from']=$pickup;
$_SESSION['to']=$drop;
$_SESSION['class']=$cabtype;
$_SESSION['status']=1;

	// $distance=array(
	// 	"Charbagh"=>"0",
	// 	"IndiraNagar"=>"10",
	// 	"BBD"=>"30",
	// 	"Barabanki"=>"60",
	// 	"Faizabad"=>"100",
	// 	"Basti"=>"150",
	// 	"Gorakhpur"=>"210",
	// );


	$conn = new mysqli('localhost','root','root','cabs');
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT name, distance FROM tbl_location WHERE is_available='1'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    $distance[$row['name']]=$row['distance'];
	  }
	    // echo "<pre>";
	    // print_r($distance);
	    // echo "</pre>";
	} else {
	  echo "0 results";
	}
// print_r($distance);
// die();
	$dis= abs($distance[$drop] - $distance[$pickup]);
$_SESSION['distance']=$dis;
	function result($result) {
		echo $result;
		$_SESSION['fare']=$result;
	}

	if ($cabtype=="CedMicro") {
		$fare=50;
		$_SESSION['luggage']=0;
		if($dis<=10){$rate=$dis*13.50;$rate=$rate+$fare;result($rate);}
		elseif ($dis>10 && $dis<=60) {
			$rate=135+(($dis-10)*12);
			$rate=$rate+$fare;
			result($rate);
		}
		elseif ($dis>60 && $dis<=160) {
			$rate=135+600+(($dis-60)*10.20);
			$rate=$rate+$fare;
			result($rate);
		}
		else{
			$rate=135+600+1020+(($dis-160)*8.50);
			$rate=$rate+$fare;
			result($rate);
		}
	}
	elseif ($cabtype=="CedMini") {
		$luggage=$_POST['luggage'];
		$fare=150;
		$fare=$fare+$luggage;
		$_SESSION['luggage']=$luggage;
		if($dis<=10){$rate=$dis*14.50;$rate=$rate+$fare;result($rate);}
		elseif ($dis>10 && $dis<=60) {
			$rate=145+(($dis-10)*13);
			$rate=$rate+$fare;
			result($rate);
		}
		elseif ($dis>60 && $dis<=160) {
			$rate=145+650+(($dis-60)*11.20);
			$rate=$rate+$fare;
			result($rate);
		}
		else{
			$rate=145+650+1120+(($dis-160)*9.50);
			$rate=$rate+$fare;
			result($rate);
		}
	}
	elseif ($cabtype=="CedRoyal") {
		$luggage=$_POST['luggage'];
		$fare=200;
		$fare=$fare+$luggage;
		$_SESSION['luggage']=$luggage;
		if($dis<=10){$rate=$dis*15.50;$rate=$rate+$fare;result($rate);}
		elseif ($dis>10 && $dis<=60) {
			$rate=155+(($dis-10)*14);
			$rate=$rate+$fare;
			result($rate);
		}
		elseif ($dis>60 && $dis<=160) {
			$rate=155+700+(($dis-60)*12.20);
			$rate=$rate+$fare;
			result($rate);
		}
		else{
			$rate=155+700+1220+(($dis-160)*10.50);
			$rate=$rate+$fare;
			result($rate);
		}
	}
	elseif ($cabtype=="CedSUV") {
		$luggage=$_POST['luggage'];
		$luggage=$luggage+$luggage;
		$fare=250;
		$fare=$fare+$luggage;
		$_SESSION['luggage']=$luggage;
		if($dis<=10){$rate=$dis*16.50;$rate=$rate+$fare;result($rate);}
		elseif ($dis>10 && $dis<=60) {
			$rate=165+(($dis-10)*15);
			$rate=$rate+$fare;
			result($rate);
		}
		elseif ($dis>60 && $dis<=160) {
			$rate=165+750+(($dis-60)*13.20);
			$rate=$rate+$fare;
			result($rate);
		}
		else{
			$rate=165+750+1320+(($dis-160)*11.50);
			$rate=$rate+$fare;
			result($rate);
		}
	}
?>