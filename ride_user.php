<?php 
session_start();
require "header.php"; 
require_once "ride_Class.php";
$user=new Ride();
?>
<?php if (isset($_GET['a'])){
			require_once "ride_Class.php";
			$r=new Ride();
			$s=$r->accept($_GET['a'],0);
			header("location:user_dashboard.php");
		}?>
<div class="row mb-5">

	<div class="w-25 d-inline-block">
		<form action='' method='post' class='ml-5'>
			<h6 class='ml-5'><strong>filter by dates</strong></h6>
		<select name='date' class="form-control">
		<option value=1 >all</option>
		<option value=2 >this week</option>
		<option value="4" >last week</option>
		<option value=3 >last month</option>
		</select>
		<input type='submit' class='btn btn-warning' name='date-filter' value='filter'>
		</form></div>
		
	<div class="w-25 d-inline-block">
		<form action='' method='post' class='ml-5'>
		<p class='ml-5'><strong>filter by cabtype</strong></p>
		<select name='cabtype' class="form-control">
		<option value='CedMicro' >CedMicro</option>
		<option value='CedMini' >CedMini</option>
		<option value='CedRoyal' >CedRoyal</option>
		<option value='CedSUV' >CedSUV</option>
		</select>
		<input type='submit' class='btn btn-warning' name='ridefilter' value="filter">
		</form></div>
		
		<div class="w-25 ">
		<form action=" " method="post" class='ml-5'>
			<h6 class='ml-5'><strong>sort by</strong></h6>
			<select name="sorttype" class="form-control">
      			<option value="total_distance">distance</option>
      			<option value="total_fare">fare</option>
      			<option value="ride_date">date</option>
   		 	</select>
			<select name="sortval" class="form-control">
				<option value="desc">descending</option>
				<option value="asc">ascending</option>
			</select>
			<input type="submit" class="btn btn-warning" name="sort" value="sort">
		</form></div>
		
	</div>
<table class="mt-2 ml-3 mb-5 table table-dark">
	<tr>
		<th>date</th>
		<th>source</th>
		<th>destination</th>
		<th>total distance</th>
		<th>luggage</th>
		<th>Cab-type</th>
		<th>fare</th>
		<th>action/status</th>
	</tr>
	<?php
	if(isset($_GET['completed']))
	{
		if($_GET['completed']==2){
			echo "<h3><strong>completed rides</strong></h3>";
			if (isset($_POST['date-filter'])) {
				if ($_POST['date']==1) {
					$sql=$user->bookings_user($_SESSION['id'],2);
				}
				elseif ($_POST['date']==2) {
				$s=strtotime("next Sunday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],2,$s1,$b);
				}
				elseif ($_POST['date']==3) {
				$s=strtotime("last day of last month");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("first day of last month"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],2,$s1,$b);
				}
				elseif ($_POST['date']==4) {
					$s=strtotime("last week monday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],2,$b,$s1);
				}

			}
			elseif(isset($_POST['sort'])){
				if ($_POST['sortval']=='desc') {
					$sql=$user->bookings_sort($_SESSION['id'],2,$_POST['sorttype'],'desc');
				}
				elseif ($_POST['sortval']=='asc') {
					$sql=$user->bookings_sort($_SESSION['id'],2,$_POST['sorttype'],'asc');
				}
			}
			elseif (isset($_POST['ridefilter'])) {
				$sql=$user->bookings_cabtype($_SESSION['id'],$_POST['cabtype'],2);
			}
			else{
				$sql=$user->bookings_user($_SESSION['id'],2);
			}
				
		}
		elseif($_GET['completed']==1){
			echo "<h3><strong>Pending rides</strong></h3>";
			if (isset($_POST['date-filter'])) {
				if ($_POST['date']==1) {
					$sql=$user->bookings_user($_SESSION['id'],1);
				}
				elseif ($_POST['date']==2) {
					$s=strtotime("next Sunday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],1,$s1,$b);
				}
				elseif ($_POST['date']==3) {
					$s=strtotime("last day of last month");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("fist day of last month"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],1,$s1,$b);
				}
				elseif ($_POST['date']==4) {
					$s=strtotime("last week monday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],1,$s1,$b);
				}
			}
			elseif(isset($_POST['sort'])){
				if ($_POST['sortval']=='desc') {
					$sql=$user->bookings_sort($_SESSION['id'],1,$_POST['sorttype'],'desc');
				}
				elseif ($_POST['sortval']=='asc') {
					$sql=$user->bookings_sort($_SESSION['id'],1,$_POST['sorttype'],'asc');
				}
			}
			elseif (isset($_POST['ridefilter'])) {
				
				$sql=$user->bookings_cabtype($_SESSION['id'],$_POST['cabtype'],1);
				
			}
			else{
			$sql=$user->bookings_user($_SESSION['id'],1);
		}
		}
		elseif($_GET['completed']==0){
			echo "<h3><strong>Cancelled rides</strong></h3>";
			if (isset($_POST['date-filter'])) {
				if ($_POST['date']==1) {
					$sql=$user->bookings_user($_SESSION['id'],0);
				}
				elseif ($_POST['date']==2) {
					$s=strtotime("next Sunday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],0,$s1,$b);
				}
				elseif ($_POST['date']==3) {
					$s=strtotime("last month");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],0,$s1,$b);
				}
				elseif ($_POST['date']==4) {
					$s=strtotime("last week monday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_user_datefilter($_SESSION['id'],0,$b,$s1);
				}
			}
			elseif(isset($_POST['sort'])){
				if ($_POST['sortval']=='desc') {
					$sql=$user->bookings_sort($_SESSION['id'],0,$_POST['sorttype'],'desc');
				}
				elseif ($_POST['sortval']=='asc') {
					$sql=$user->bookings_sort($_SESSION['id'],0,$_POST['sorttype'],'asc');
				}
			}
			elseif (isset($_POST['ridefilter'])) {
				
				$sql=$user->bookings_cabtype($_SESSION['id'],$_POST['cabtype'],0);
				
			}
			else{
			$sql=$user->bookings_user($_SESSION['id'],0);
		}	
		}

	}
	elseif(isset($_GET['all']))
	{	
		echo "<h3 class='ml-5'><strong>all rides</strong></h3>";
		if(isset($_POST['date-filter']))
		{
			if($_POST['date']==1)
			{
				$sql=$user->bookings($_SESSION['id']);
			}
			elseif ($_POST['date']==2) {
				$s=strtotime("next Sunday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_date($_SESSION['id'],$s1,$b);
			}elseif($_POST['date']==3){
				$s=strtotime("last month");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_date($_SESSION['id'],$s1,$b);
			}
			elseif($_POST['date']==4){
				$s=strtotime("last week monday");
				$b =date("Y-m-d",$s);
				$s1=date("Y-m-d",strtotime("last sunday"));
				$sql=$user->bookings_date($_SESSION['id'],$b,$s1);
			}
		}
		elseif(isset($_POST['sort'])){
				if ($_POST['sortval']=='desc') {
					echo $_POST['sorttype'];
					$sql=$user->bookings_allsort($_SESSION['id'],$_POST['sorttype'],'desc');
				}
				elseif ($_POST['sortval']=='asc') {
					$sql=$user->bookings_allsort($_SESSION['id'],$_POST['sorttype'],'asc');
				}
			}
			elseif (isset($_POST['ridefilter'])) {

				$sql=$user->bookings_cabtypeall($_SESSION['id'],$_POST['cabtype']);
			}
		else
		{
			$sql=$user->bookings($_SESSION['id']);
		}
	}
	$num=mysqli_num_rows($sql);
	if($num>0){
	while ($rows=mysqli_fetch_assoc($sql)) {
		?>
		<tr><?php
			echo "<td>".$rows['ride_date']."</td>";
			echo "<td>".$rows['from.']."</td>";
			echo "<td>".$rows['to.']."</td>";
			echo "<td>".$rows['total_distance']." km</td>";
			echo "<td>".$rows['luggage']." kg</td>";
			echo "<td>".$rows['cabtype']."</td>";
			echo "<td> Rs. ".$rows['total_fare']."</td>";
			if ($rows['status']==1) {
				echo "<td><a href='ride_user.php?a=".$rows['ride_id']."' onClick=\"javascript: return confirm('Please confirm deletion');\">cancel</a><td>";
			}elseif($rows['status']==0){
				echo "<td>cancelled</td>";
			}
			elseif($rows['status']==2){
				echo "<td>completed</td>";
			}
			?>
		</tr>
	<?php }
		}else{
			echo "<td>no records found</td>";
		}
		

		?>
</table>

<?php include "footer.php"; ?>
</body>
</html>