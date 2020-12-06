<?php require"adminheader.php";
require_once "location.php";
$user=new Location();
if(isset($_GET['show'])){
	echo "<h3><strong>Locations</strong></h6>";
	$sql=$user->loc();?>

	<table class="mt-5 ml-5 table table-dark">
		<tr>
			<th>locations</th>
			<th>distance</th>
			<th>availability</th>
			<th>Actions</th>
		</tr>
<?php
	while($rows=mysqli_fetch_assoc($sql)){
		echo "<tr>";
		echo "<td>".$rows['name']."</td>";
		echo "<td>".$rows['distance']." km</td>";
		if($rows['is_available']==0)
		{
			echo "<td> not available </td>";
		}
		else{
			echo "<td>available</td>";
		}
		echo "<td><a href='locations_admin.php?action=1&id=".$rows['id']."&name=".$rows['name']."&distance=".$rows['distance']."&is_available=".$rows['is_available']."'>update</a></td>";
		echo "<td><a href='locations_admin.php?action=2&id=".$rows['id']."' onclick(alert('deleted successfully');)>delete</a></td>";
		echo "</tr>";
		
	}
	echo "</table>";
	
}
if(isset($_GET['action']))
	{
		if($_GET['action']=='1')
		{
			echo "<h3>update location</h3>";
			?>
			<div class="mx-auto w-25 text-center">
			<form action="" method="post">
			<?php echo "<input type='text' hidden value=".$_GET['id']." name='id1' class='form-control'>";
				 echo"<input type='text' value='".$_GET['name']."' name='location' class='form-control'>";
				echo"<input type='text' value='".$_GET['distance']."' name='distance'class='form-control'>";
				echo "<select name='active' class='form-control'>";
					echo "<option value=1>active</option>";
					echo "<option value=0>inactive</option>";
				echo "</select>";
				?>
				<input type="submit" name="update" class='btn btn-warning'>
			</form>
		</div>
		<?php
		}
		elseif ($_GET['action']=='2')
		{
			
			$sql=$user->del_loc($_GET['id']);
			header("location:admin2.php");
		}
	}
elseif(isset($_GET['add_loc']))
{
	echo "<h3 class='mt-3'><strong>Add Locations</strong></h3>";
	?>
	<div class="mx-auto w-25 text-center mt-5">
	<form action="" method="post" class="mt-5">
		<input type="text" name="name" placeholder="location-name" pattern="[a-zA-Z]+[a-zA-Z0-9\s]"class='form-control'>
		<input type="number" name="distance" placeholder="distance(in kms)" class='form-control'>
		<select name="status" class='form-control'>
			<option value=1>active</option>
			<option value=0>inactive</option>
		</select>
		<input type="submit" name="add_loc" class="btn btn-warning">
	</form>
</div>
<?php
}
?>
<?php
  if(isset($_POST['update'])){
    $name=$_POST['location'];
    $id=$_POST['id1'];
    $dis=$_POST['distance'];
    $status=$_POST['active'];
    require_once "location.php";
    $user= new Location();
    $sql=$user->dis_update($name,$dis,$status,$id);
    if($sql){
    	echo "edited";
    }
    else{
    	echo "no changes made";
    }
  }
  if(isset($_POST['add_loc'])){
  	$name=$_POST['name'];
  	$dis=$_POST['distance'];
  	$status=$_POST['status'];
  	require_once "location.php";
  	$user= new Location;
  	$sql=$user->add_location($name,$dis,$status);
  	if($sql){
  		echo "location added";
  	}
  	else{
  		echo "cant be added because it already exists";
  	}
  }
?>
<?php include "footer.php"; ?>
</body>
</html>
