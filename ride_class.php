<?php
class Ride
{
	function __construct(){
		$con=mysqli_connect('localhost','root','root','cabs');
		$this->dbh=$con;
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			//echo "connected";
		}
	}
	public function ride_data($from,$to,$distance,$luggage,$total,$customerid,$class){
		$result=mysqli_query($this->dbh,"INSERT INTO `tbl_ride`(`ride_date`, `from.`, `to.`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`,`cabtype`) VALUES ('".date("Y-m-d")."','".$from."','".$to."','".$distance."','".$luggage."','".$total."','1','".$customerid."','".$class."')");
	}
	public function bookings_cabtype($id,$ct,$a){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `cabtype` = '".$ct."' AND `status`=".$a);
		return $result;
	}
	public function bookings_cabtypeadmin($ct,$a){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `cabtype` = '".$ct."' AND `status`=".$a);
		return $result;
	}
	public function bookings_cabtypealladmin($ct){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `cabtype` = '".$ct."'");
		return $result;
	}
	public function bookings_cabtypeall($id,$ct){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `cabtype` = '".$ct."'");
		return $result;
	}

	public function bookings($id){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' order by `ride_date`");
		return $result;
	}
	public function bookings_allsort($id,$a,$b){
		if($a=='total_fare') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`=".$id." ORDER BY cast(`total_fare` as unsigned) ".$b);
		}
		elseif ($a=='total_distance') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`=".$id." ORDER BY cast(`total_distance` as unsigned) ".$b);
		}
		elseif($a=='ride_date'){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' order by `".$a."` ".$b);}
		return $result;
	}
	public function bookingcount_user($id,$s){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status`=".$s." order by `ride_date`");
		$num=mysqli_num_rows($result);
		return $num;
	}
	public function bookings_user($id,$a){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status`=".$a." order by `ride_date`");
		return $result;
	}
	public function bookings_sort($id,$a,$c,$b){
		if ($c=='total_fare') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`= ".$a." AND `customer_user_id`=".$id." ORDER BY cast(`total_fare` as unsigned) ".$b);
		}
		elseif ($c=='total_distance') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`= ".$a." AND `customer_user_id`=".$id." ORDER BY cast(`total_distance` as unsigned) ".$b);
		}
		else
		{
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status`=".$a." order by `".$c."` ".$b);
		}
		return $result;
	}

	public function bookings_user_datefilter($id,$a,$d1,$d2){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status`=".$a." AND `ride_date` BETWEEN '".$d1."' AND '".$d2."'");
		return $result;
	}


	public function bookings_date($id,$d1,$d2){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `ride_date` BETWEEN '".$d1."' AND '".$d2."' AND `customer_user_id`=".$id);
		return $result;
	}
	public function earning(){
		$t=0;
		$result=mysqli_query($this->dbh,"SELECT `total_fare` FROM `tbl_ride` WHERE `status`=2");
		while($rows=mysqli_fetch_assoc($result)){
			$t+=$rows['total_fare'];
		}
		return $t;
	}

	public function spendings($id){
		$t=0;
		$result=mysqli_query($this->dbh,"SELECT `total_fare` FROM `tbl_ride` WHERE `status`=2 AND`customer_user_id` =".$id);
		while($rows=mysqli_fetch_assoc($result)){
			$t+=$rows['total_fare'];
		}
		return $t;
	}
	public function rides($s){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`=".$s);
		return $result;
	}
	public function rides_filterdate($s,$d1,$d2){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`=".$s." AND `ride_date` BETWEEN '".$d1."' AND '".$d2."'");
		return $result;
	}
	public function allrides(){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride`");
		return $result;
	}
	public function allrides_filterdate($d1,$d2){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `ride_date` BETWEEN '".$d1."' AND'".$d2."'");
		return $result;
	}
	public function accept($rideid,$s){
		$result=mysqli_query($this->dbh,"UPDATE `tbl_ride` SET `status`=".$s." WHERE `ride_id`=".$rideid);
		return $result;
	}
	public function earning_dt($d){
		$t=0;
		$result=mysqli_query($this->dbh,"SELECT `total_fare` FROM `tbl_ride` WHERE `status`=2 AND `ride_date`= '".$d."'");
		while($rows=mysqli_fetch_assoc($result)){
			$t += $rows['total_fare'];
		}
		return $t;
	}
	public function sortadmin($a,$b,$c){
		if ($b=='total_fare') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`= ".$a." ORDER BY cast(`total_fare` as unsigned) ".$c);
		}
		if ($b=='total_distance') {
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`= ".$a." ORDER BY cast(`total_distance` as unsigned) ".$c);
		}
		else{
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride` WHERE `status`= ".$a." ORDER BY `".$b."` ".$c);}
		return $result;
	}
	public function sortadminall($b,$c){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_ride`  ORDER BY `".$b."` ".$c);
		return $result;
	}
}
?>