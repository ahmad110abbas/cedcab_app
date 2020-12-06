<?php

class Location 
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
	public function check_distance($loc){
		$result=mysqli_query($this->dbh,"SELECT `distance` FROM `tbl_location` WHERE `name`='".$loc."'");
		$row=$result->fetch_assoc();

		return $row['distance'];
	}
	public function loc(){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_location` order by `distance`");
		return $result;
	}
	public function del_loc($a){
		$result=mysqli_query($this->dbh,"DELETE FROM `tbl_location` WHERE `id`=".$a);
		return $result;
	}
	public function loc_user(){
		$result=mysqli_query($this->dbh,"SELECT * FROM `tbl_location` WHERE `is_available` = 1 order by `distance` ");
		return $result;
	}
	public function dis_update($name,$dis,$a,$id){
		$result=mysqli_query($this->dbh,"UPDATE `tbl_location` SET `name`='".$name."',`distance`='".$dis."',`is_available`=".$a." WHERE `id`=".$id);
		return mysqli_affected_rows($this->dbh);
	}
	public function add_location($name,$dis,$s){
		$result=mysqli_query($this->dbh,"INSERT INTO `tbl_location`(`name`, `distance`, `is_available`) VALUES ('".$name."','".$dis."',".$s.")");
			return mysqli_affected_rows($this->dbh);
	}
}
?>