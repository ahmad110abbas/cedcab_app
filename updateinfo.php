<?php
session_start();
require"header.php";
if (isset($_GET['namechange'])) {
 require_once "users.php";	
$u=new Users();
$n=$u->update_u($_SESSION['user']);

echo "<div class='mx-auto  color-white w-25 text-center' ><form class='mt-5 ml-5' action='' method='post' class='p2'>
	<p class='font-weight-bold  mt-5 ml-1' color-light>Enter name:</p>
	<input type='text' name='name' value='".$n['name']."' pattern='^[a-zA-Z ]*$'class='form-control' style='margin-right:10px;'>
	<p class='font-weight-bold mt-2'>mobile:</p>
	<input type='number' name='mobile' value='".$n['mobile']."' class='form-control pattern='[1-9]{1}[0-9]{9}'>
	<input type='submit' name='update' class= 'btn btn-warning mt-2' onclick=\"javascript: return alert('changes made');\";>
</form></div>";

	if (isset($_POST['name'])) {
		if($_POST['name']==""){
			echo "name can't be empty";
		}
		elseif ($_POST['mobile']=="") {
			echo "mobile cant be empty";
		}
		else{
		require_once "users.php";
		$user=new Users();
		$sql=$user->update_name($_SESSION['user'],$_POST['name'],$_POST['mobile']);
		header("location:home_user.php");
	}
	}
}
elseif (isset($_GET['password'])) {
	
echo "<div class='mx-auto  color-white w-25 text-center' ><form class='mt-5 ml-5' action='' method='post'>
	<span class='font-weight-bold  mt-5 ml-2' >Enter old Password:</span>
	<input type='password' name='pass' placeholder='enter old password' class='form-control'>
	<p class='font-weight-bold  mt-5 ml-2'>Enter new Password:</p>
	<input type='password' name='pass2' placeholder='enter new password' class='form-control' pattern='.{8,}'>
	<p></p>
	<input type='submit' name='passbtn' class='btn btn-warning'>
	<p></p>
</form></div>";
	if(isset($_POST['passbtn'])){
		if($_POST['pass']==""||$_POST['pass2']==""){
			echo "password cant be empty";
		}
		else{
			require_once "users.php";
			$user=new Users();
			$sql=$user->update_pass($_SESSION['user'],$_POST['pass'],$_POST['pass2']);
			if($sql==1){
				echo "<script>alert('password changed');</script>";
				echo "<script>window.location.href = 'login.php?logout=1';</script>";
				 
			}
			else{
				echo "password wrong";
			}
			
		}
	}
}
?> 

<?php include "footer.php" ?>
</body>
</html>