<?php require"adminheader.php";
require_once "ride_Class.php";
$user=new Ride();?>
<?php
if (isset($_GET['ride_id'])) {
        if ($_GET['status']==1) {
          $new=new Ride();
          $sql=$new->accept($_GET['ride_id'],2);
          // header("location:adminuser.php");
          echo '<script>window.location.href = "admin_user.php";</script>';
          

        }
        elseif ($_GET['status']==2) {
          $new=new Ride();
          $sql=$new->accept($_GET['ride_id'],0);
          // header("location:adminuser.php");
          echo '<script>window.location.href = "admin_user.php";</script>';
        }
      }
?>
<div class="row mt-2 ml-3 w-50">

<div class="w-25 d-inline-block">
  <form action="" method="post" >
    <p><strong>filter by date:</strong></p>
    <select name="date" class="form-control">
      <option value="1">all</option>
      <option value="2">this week </option>
      <option value="3">last week</option>
      <option value="4">last month</option>
    </select>
    <input type="submit" name="filter-date" class="btn btn-warning " value="filter">
  </form>
  </div>
  <div class="w-25 d-inline-block ">
    <form action='' method='post' class='ml-5'>
    <p class='ml-5'><strong>filter by cabtype</strong></p>
    <select name='cabtype' class="form-control">
    <option value='CedMicro' >CedMicro</option>
    <option value='CedMini' >CedMini</option>
    <option value='CedRoyal' >CedRoyal</option>
    <option value='CedSUV' >CedSUV</option>
    </select>
    <input type='submit' class='btn btn-warning' name='ridefilter' value="filter">
    </form>
  </div>
  <div class="form-group w-25 ml-5" >
  <form action="" method="post">
    <span><strong>sort by:</strong></span>
    <select name="sorttype" class="form-control">
      <option value="total_distance">distance</option>
      <option value="total_fare">fare</option>
      <option value="ride_date">date</option>
    </select>
    <select name="order" class="form-control">
      <option value="desc">descending</option>
      <option value="asc">ascending</option>    
    </select>
    <input type="submit" name="sortby" class="btn btn-warning" value="sort">
  </form>

  </div>
</div>

<table class="mt-2 ml-3 table table-dark">
  					<tr>
    					<th>Ride_id</th>
    					<th>Ride Date</th>
    					<th>from</th>
    					<th>to</th>
    					<th>total distance</th>
    					<th>luggage</th>
    					<th>total fare</th>
    					<th>customer-id</th>
              <th>cab-type</th>
    					<th>action/status</th>
  					</tr>
  		<?php
  				if (isset($_GET['rides'])) {
  					
  					if($_GET['rides']==1){
  						echo "<h3>Pending Rides</h3>";
              if(isset($_POST['filter-date']))
              {
                if ($_POST['date']==1) {
                  $sql=$user->rides(1);
                }
                elseif ($_POST['date']==2) {
                   $s=strtotime("next Sunday");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->rides_filterdate(1,$s1,$b);
                }
                elseif ($_POST['date']==3) {
                  $s=strtotime("monday of last week");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last week"));
                  $sql=$user->rides_filterdate(1,$s1,$b);
                }
                elseif ($_POST['date']==4) {
                    $s=strtotime("first day of last month");
                    $b =date("Y-m-d",$s);
                    $s1=date("Y-m-d",strtotime("last day of last month"));
                    $sql=$user->rides_filterdate(1,$b,$s1);
                }
              }
              elseif (isset($_POST['ridefilter']))
              {
              $sql=$user->bookings_cabtypeadmin($_POST['cabtype'],1);

              }
              elseif (isset($_POST['sortby'])) {
                $sql=$user->sortadmin(1,$_POST['sorttype'],$_POST['order']);
              }
                else{
  						    $sql=$user->rides(1);
                }
  					}
  					elseif ($_GET['rides']==2) {
  						echo "<h3>Completed Rides</h3>";
               if(isset($_POST['filter-date']))
              {
                if ($_POST['date']==1) {
                  $sql=$user->rides(2);
                }
                elseif ($_POST['date']==2) {
                   $s=strtotime("next Sunday");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->rides_filterdate(2,$b,$s1);
                }
                elseif ($_POST['date']==3) {
                  $s=strtotime("monday of last week");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last week"));
                  $sql=$user->rides_filterdate(2,$s1,$b);
                }
                elseif ($_POST['date']==4) {
                    $s=strtotime("first day of last month");
                    $b =date("Y-m-d",$s);
                    $s1=date("Y-m-d",strtotime("last day of last month"));
                    $sql=$user->rides_filterdate(2,$b,$s1);
                }
              }
              elseif (isset($_POST['ridefilter']))
              {
              $sql=$user->bookings_cabtypeadmin($_POST['cabtype'],2);

              }
              elseif (isset($_POST['sortby'])) {
                $sql=$user->sortadmin(2,$_POST['sorttype'],$_POST['order']);
              }
                else{
  						$sql=$user->rides(2);
            }
  					}
  					elseif($_GET['rides']==3){
  						echo "<h3>Cancelled Rides</h3>";
               if(isset($_POST['filter-date']))
              {
                if ($_POST['date']==1) {
                  $sql=$user->rides(0);
                }
                elseif ($_POST['date']==2) {
                   $s=strtotime("next Sunday");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->rides_filterdate(0,$b,$s1);
                }
                elseif ($_POST['date']==3) {
                  $s=strtotime("monday of last week");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->rides_filterdate(0,$b,$s1);
                }
                elseif ($_POST['date']==4) {
                    $s=strtotime("first day of last month");
                    $b =date("Y-m-d",$s);
                    $s1=date("Y-m-d",strtotime("last day of last month"));
                    $sql=$user->rides_filterdate(0,$b,$s1);
                }
              }
              elseif (isset($_POST['ridefilter']))
              {
              $sql=$user->bookings_cabtypeadmin($_POST['cabtype'],0);

              }
              elseif (isset($_POST['sortby'])) {
                $sql=$user->sortadmin(0,$_POST['sorttype'],$_POST['order']);
              }
                else{
  						$sql=$user->rides(0);
            }
  					}
  					else{
               if(isset($_POST['filter-date']))
              {
                if ($_POST['date']==1) {
                  $sql=$user->allrides();
                }
                elseif ($_POST['date']==2) {
                   $s=strtotime("next Sunday");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->allrides_filterdate($s1,$b);
                }
                elseif ($_POST['date']==3) {
                  $s=strtotime("monday of last week");
                  $b =date("Y-m-d",$s);
                  $s1=date("Y-m-d",strtotime("last sunday"));
                  $sql=$user->allrides_filterdate($b,$s1);
                }
                elseif ($_POST['date']==4) {
                    $s=strtotime("first day of last month");
                    $b =date("Y-m-d",$s);
                    $s1=date("Y-m-d",strtotime("last day of last month"));
                    $sql=$user->allrides_filterdate($b,$s1);
                }
              }
              elseif (isset($_POST['ridefilter']))
              {
              $sql=$user->bookings_cabtypealladmin($_POST['cabtype']);

              }
              elseif (isset($_POST['sortby'])) {
                $sql=$user->sortadminall($_POST['sorttype'],$_POST['order']);
              }
                else{
  						$sql=$user->allrides();
            }
  					}
            // if(!isset($)){
            //   $sql=$user->allrides();
            // }
            $num=mysqli_num_rows($sql);
            if($num==0){
              echo "<td>no records</td>";
            }
            else{
  			while($rows=mysqli_fetch_assoc($sql)){
  				echo "<tr>";
  				echo "<td>".$rows['ride_id']."</td>";
  				echo "<td>".$rows['ride_date']."</td>";
  				echo "<td>".$rows['from.']."</td>";
  				echo "<td>".$rows['to.']."</td>";
  				echo "<td>".$rows['total_distance']." km</td>";
  				echo "<td>".$rows['luggage']." kg</td>";
  				echo "<td>Rs.".$rows['total_fare']."</td>";
  				echo "<td>".$rows['customer_user_id']."</td>";
          echo "<td>".$rows['cabtype']."</td>";
  				echo "<td>";
  				if($rows['status']==1){
  					echo "<a href='adminrides.php?ride_id=".$rows['ride_id']."&status=1&customer-id=".$rows['customer_user_id']."'> confirm</a>";
  					echo "&nbsp";
  					echo "<a href='adminrides.php?ride_id=".$rows['ride_id']."&status=2&customer-id=".$rows['customer_user_id']."' onClick=\"javascript: return confirm('Please confirm deletion');\">reject</a>";
  				}
  				elseif($rows['status']==2)
          {
  					echo "Completed";
  				}
  				elseif($rows['status']==0){
  					echo "cancelled";
  				}
  				echo "</td>";
  				echo "</tr>";
  			}
  		}}
  		
  		?>

</table>
<?php include "footer.php"; ?>
</body>
</html>