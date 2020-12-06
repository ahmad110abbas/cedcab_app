
 <?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location:login.php");
}

  require "header.php" ;

require_once "ride_Class.php";
$user=new Ride();
echo "<h1>WELCOME ".$_SESSION['user']."</h1>";
?>

<div class="card-columns text-white mt-2 ml-5">

<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header" style="background-color: white;"><a href="ride_user.php?completed=2">More Info</a></div>
  <div class="card-body">
    <h5 class="card-title">Completed Rides</h5>
            <?php
        	$sql=$user->bookingcount_user($_SESSION['id'],2);
        	echo '<p class="card-text">'.$sql.'</p>';
        ?>
  </div>
</div>

<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header" style="background-color: white;"><a href="ride_user.php?completed=1">More Info</a></div>
  <div class="card-body">Pending Rides Request</h5>
            <?php
        	$sql=$user->bookingcount_user($_SESSION['id'],1);
        	echo '<p class="card-text">'.$sql.'</p>';
        ?>
  </div>
</div>


<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-header" style="background-color: white;"><a href="ride_user.php?completed=0">More Info</a></div>
  <div class="card-body">Cancelled Rides Request</h5>
            <?php
        	$sql=$user->bookingcount_user($_SESSION['id'],0);
        	echo '<p class="card-text">'.$sql.'</p>';
        ?>
  </div>
</div>

    </div>
    <div class="card text-white bg-primary mb-3 ml-5" style="max-width: 75rem;text-align: center;">
      <div class="card-header">Total Spendings</div>
      <div class="card-body">
        <h5 class="card-title">you have spent a total of:</h5>
        <p class="card-text text-white">
        	<?php
        		$sql=$user->spendings($_SESSION['id']);
        		echo "<h3>₹".$sql."</h3>";
        	?>
        </p>
      </div>
</div>
<?php require "footer.php"; ?>
<!-- <footer class="page-footer font-small mt-5 bg-light">

  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="index.php"> Cedcabs.com</a>
  </div>


</footer> -->


</body>
</html>