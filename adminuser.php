<?php require "adminheader.php";
	require_once "users.php";
	$user=new Users();?>
  <div class="row ml-5">
  <div class="form-group w-25">
  <form action="" method="post">
    <span><strong>filter</strong></span>
    <select name="date" class="form-control">
      <option value="1">all</option>
      <option value="2">this week</option>
      <option value="3">last month</option>
      <option value="4">last week</option>
    </select>
    <input type="submit" name="filter" class="btn btn-warning">
  </form>
</div>

  <div class="form-group w-25 ml-5" >
  <form action="" method="post">
    <span><strong>sort by:</strong></span>
    <select name="sorttype" class="form-control">
      <option value="name">name</option>
      <option value="dateofsignup">date</option>
    </select>
    <select name="order" class="form-control">
      <option value="desc">desc</option>
      <option value="asc">asc</option>    
    </select>
    <input type="submit" name="sortby" class="btn btn-warning">
  </form>

  </div>
</div>
	<table class="mt-2 ml-5 table table-dark">
  					<tr>
    					<th>Name</th>
    					<th>Username</th>
    					<th>Date of Signup</th>
    					<th>action</th>
  					</tr>
<?php
if(isset($_GET['user_pending'])){
  if (isset($_POST['filter'])) 
  {
    if ($_POST['date']==1) {
      $sql=$user->userdata(1);
    }
    elseif ($_POST['date']==2) {
      $s=strtotime("next Sunday");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->userdata_filter_date(1,$b,$s1);
    }
    elseif ($_POST['date']==3) {
        $s=strtotime("first day of last month");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last day of last month"));
        $sql=$user->userdata_filter_date(1,$b,$s1);
    }
    elseif ($_POST['date']==4) {
        $s=strtotime("monday of last week");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->userdata_filter_date(1,$b,$s1);
    }
  }
  elseif (isset($_POST['sortby'])) {
        $sql=$user->usersort($_POST['sorttype'],$_POST['order'],1);
  }
  else{
    $sql=$user->userdata(1);
  }
	
	}
elseif (isset($_GET['user_accepted'])) {
	if (isset($_POST['filter'])) 
  {
    if ($_POST['date']==1) {
      $sql=$user->userdata(0);
    }
    elseif ($_POST['date']==2) {
      $s=strtotime("next Sunday");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->userdata_filter_date(0,$b,$s1);
    }
    elseif ($_POST['date']==3) {
        $s=strtotime("first day of last month");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last day of last month"));
        $sql=$user->userdata_filter_date(0,$b,$s1);
    }
    elseif ($_POST['date']==4) {
        $s=strtotime("monday of last week");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->userdata_filter_date(0,$b,$s1);
    }
  }
  elseif (isset($_POST['sortby'])) {
        $sql=$user->usersort($_POST['sorttype'],$_POST['order'],0);
  }
  else
  {
    $sql=$user->userdata(0);
  }
}
else{
  if(isset($_POST['filter']))
  {
    if ($_POST['date']==1) {
      $sql=$user->all_users();
    }
    elseif ($_POST['date']==2) {
      $s=strtotime("next Sunday");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->all_users_filter($b,$s1);
    }
    elseif ($_POST['date']==3) {
        $s=strtotime("first day of last month");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last day of last month"));
        $sql=$user->all_users_filter($b,$s1);
    }
    elseif ($_POST['date']==4) {
        $s=strtotime("monday of last week");
        $b =date("Y-m-d",$s);
        $s1=date("Y-m-d",strtotime("last sunday"));
        $sql=$user->all_users_filter($b,$s1);
    }
  }
  elseif (isset($_POST['sortby'])) {
        $sql=$user->usersort_all($_POST['sorttype'],$_POST['order']);
  }
  else
  {
    $sql=$user->all_users();
  }
	
}
$num=mysqli_num_rows($sql);
if ($num==0) {
  echo "<td>no records</td>";
}
else{
while($rows=mysqli_fetch_assoc($sql))
{

	echo "<tr>";
    		echo "<td>".$rows['name']."</td>";
    		echo "<td>".$rows['user_name']."</td>" ;
   			echo "<td>".$rows['dateofsignup']."</td>";
    		echo "<td> <a onClick=\"javascript: return confirm('confirm');\" href='adminuser.php?username=".$rows['user_name']."&acpt=";if(isset($_GET['user_pending'])){echo "1";}elseif(isset($_GET['user_accepted'])){echo "2";} echo "'>";if(isset($_GET['user_pending'])){echo "accept";}elseif (isset($_GET['user_accepted'])) {
    			echo "block";}elseif(isset($_GET['all_users'])){
    			echo "";}
    		echo "</a></td>";
 			echo "</tr>";

 }
 if(isset($_GET['acpt'])){
 	if($_GET['acpt']==1){
 		$username=$_GET['username'];
 		$s=$user->request_accept($username,0);
 	}
 	elseif ($_GET['acpt']==2) {
 		$username=$_GET['username'];
 		$s=$user->request_accept($username,1);
 	}
 }
}
?>
</table>
<?php include "footer.php"; ?>
</body>
<html>
