<?php require"adminheader.php";?>
<?php require_once"ride_Class.php";
  $user=new Ride();?>
<div class="card-columns text-white mt-2 ml-5">
      <div class="card mt-2 mb-3 bg-success sha">
        <div class="card-header"><a href="adminrides.php?rides=2" class="">take me there</a></div>
        <div class="card-body">
          <h5 class="card-title">Completed Rides : </h5>
        <?php $c=$user->rides(2);
          $completed=mysqli_num_rows($c);
          echo "<h3>".$completed."</h3>";?>
           
          <br>
          
        </div>
      </div>
      <div class="card mt-2 mb-3 sha bg-warning w-75">
        <div class="card-header"> <a href="adminrides.php?rides=1" class="">take me there</a></div>
        <div class="card-body">
          <h5 class="card-title">Pending Ride Requests : </h5>
          <?php $c=$user->rides(1);
          $completed=mysqli_num_rows($c);
          echo "<h3>".$completed."</h3>";?>
     
          <br>
         
        </div>
      </div>
      <div class="card mt-2 mb-3 bg-danger sha w-75">
        <div class="card-header"><a href="adminrides.php?rides=3" class="">take me there</a></div>
        <div class="card-body">
          <h5 class="card-title">Cancelled Ride Requests : </h5>
          <?php $c=$user->rides(0);
          $completed=mysqli_num_rows($c);
          echo "<h3>".$completed."</h3>";?>
          <br>
          
        </div>
      </div>
    </div>
      <div class="card-columns text-white mt-5 ml-5  ">
        <div class="card mt-2 mb-3 sha bg-info">
        <div class="card-body">
          <h5 class="card-title">Total Earnings : </h5>
          <?php
          $total=$user->earning()?>
          <h2>₹<?php echo $total;?></h2>
        <div class="md-3">     
    </div>
        </div>
      </div>
      <div class="card mt-2 mb-3 sha bg-warning w-75">
        <div class="card-header"><a href="adminuser.php?user_pending=1" class="">take me there</a></div>
        <div class="card-body">
          <h4 class="card-title">Pending user Requests : </h4>
          <h5>Inactive accounts</h5>
          <?php
              require_once "users.php";
              $user=new Users();
              $sql=$user->count_users(1);
              echo "<h3>".$sql."</h3>";
          ?>
          <br>
          
        </div>
      </div>

      <div class="card mt-2 mb-3 bg-success sha w-75">
        <div class="card-header"><a href="adminuser.php?user_accepted=1" class="">take me there</a></div>
        <div class="card-body">
          <h4 class="card-title">Active Users : </h4>
          <h5>Up and Running accounts</h5>
           <?php
              require_once "users.php";
              $user=new Users();
              $sql=$user->count_users(0);
              echo "<h3>".$sql."</h3>";
          ?>
          <br>
          
        </div>
      </div>
      

            
    </div>
<?php include "footer.php"; ?>
</body>
</html>
