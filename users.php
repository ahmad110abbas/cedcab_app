<?php
/**
 * 
 */
class Users
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
	public function usersort($a,$b,$c){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_user` WHERE `isblock`= ".$c." ORDER BY `".$a."` ".$b."");
		return $result;
	}
	public function usersort_all($a,$b){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_user` ORDER BY `".$a."` ".$b."");
		return $result;
	}

	public function userdata($a){
		$result=mysqli_query($this->dbh,"select `user_name`,`dateofsignup`,`name`,`user_id` from `tbl_user` where `isblock`=".$a." AND `isadmin`= 0");
		return($result);
	}

	public function userdata_filter_date($a,$b,$c){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_user` WHERE `isblock`=".$a." AND `dateofsignup` BETWEEN '".$b."' AND '".$c."'");
		return($result);
	}
	public function count_users($a){
		$result=mysqli_query($this->dbh,"SELECT  `name` FROM `tbl_user` WHERE `isblock`=".$a);
		$num=mysqli_num_rows($result);
		return($num);
	}

	public function all_users(){
		$result=mysqli_query($this->dbh,"select * from `tbl_user` WHERE `isadmin`='0'");
		return($result);
	}
	public function all_users_filter($d1,$d2){
		$result=mysqli_query($this->dbh,"select * from `tbl_user` WHERE `isadmin`='0' AND `dateofsignup` BETWEEN '".$d1."' AND '".$d2."'");
		return($result);
	}

	public function request_accept($username,$a)
	{
		$result=mysqli_query($this->dbh,"UPDATE `tbl_user` SET `isblock`=".$a." WHERE `user_name`='".$username."' AND `isadmin` = '0'");

	}
	public function update_name($username,$name,$m){
		$result=mysqli_query($this->dbh,"UPDATE `tbl_user` SET `name`='".$name."',`mobile`= '".$m."' WHERE `user_name`='".$username."'");
		return $result;
	}
	public function update_u($username){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_user` WHERE `user_name`= '".$username."'");
		$row=mysqli_fetch_assoc($result);
		return $row;
	}

	public function update_pass($username,$old,$new){
		$old=md5($old);
		$new=md5($new);
		$result=mysqli_query($this->dbh,"UPDATE `tbl_user` SET `password`='".$new."' WHERE `user_name`='".$username."' AND`password`='".$old."'");
		 return mysqli_affected_rows($this->dbh);
	}

}

?>