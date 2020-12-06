<?php require"adminheader.php";
if(isset($_GET['password'])){
	?>
	<div class="mx-auto w-25 text-center">
	<form action="" method="post" class="mt-5 ml-5">
		<p class="font-weight-bold  mt-5 ml-2">Enter old Password</p>
		<input type="password" placeholder="enter old password" name="pass1" class="form-control">
		<p class="font-weight-bold  mt-3 ml-2">enter new password</p>
		<input type="password" placeholder="enter new password"name="pass2" class="form-control" pattern=".{8,}">
		<p></p>
		<input type="submit" name="change_pass" class="btn btn-warning">
	</form>
</div>
	<?php if(isset($_POST['change_pass'])){
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		require_once "users.php";
		$user=new Users();
		if($pass1==""||$pass2==""){
			echo "passwords can't be empty";
		}
		else{
			$sql=$user->update_pass($_SESSION['user'],$pass1,$pass2);
			if($sql==1){
				echo " password successfully changed";
			}
			else{
				echo "<span class='bg-danger w-25 p-1 mt-2'>there is some error</span>";
			}
		}
	}
	?>
<?php
}
?>
<?php include "footer.php"; ?>
</body>
</html>