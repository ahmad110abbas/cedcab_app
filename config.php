<?php

class DB_con
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
	public function usernameavailblty($uname)
		{
	$result =mysqli_query($this->dbh,"SELECT `user_name` FROM `tbl_user` WHERE `User_name`='".$uname."'");
			return $result;
		}
		public function registration($fname,$uname,$mob,$pasword)
		{	$date=date("Y-m-d");
			$password=md5($pasword);
			$ret=mysqli_query($this->dbh,"INSERT INTO `tbl_user`(`user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `isadmin`) VALUES ('".$uname."','".$fname."','".$date."','".$mob."','1','".$password."','0')");
			return $ret;
		}
		public function signin($uname,$pasword)
		{	
			$password=md5($pasword);
			$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_user` WHERE `user_name` ='".$uname."' AND `password`='".$password."'");
			return $result;
		}
}
?>