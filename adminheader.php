<?php 
	session_start();
 ?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style type="text/css">
      html,body
{
    min-width: 100%;
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px !important;
    overflow-x: hidden; 
}
        #logo{
            font-size: 25px;
            margin-top: 15px;
        }
        #clr{
            color: red;
        }
        .sp{
            margin-left: 10px;
        }
    </style>
    <title>CedCab</title>
  </head>
  <body>
   <section>
        <section class="">
  <nav class="navbar navbar-expand-lg navbar-light py-0"style="background-color: #fabd06;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="admin_user.php"><p id="logo">Ced<span id="clr">Cab</span></p></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link m-auto" href="admin_user.php">Welcome Admin<span class="sr-only">(current)</span></a>
        </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rides
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminrides.php?rides=2">Completed Rides</a>
          <a class="dropdown-item" href="adminrides.php?rides=1">Pending Rides</a>
          <a class="dropdown-item" href="adminrides.php?rides=3">Canceled Rides</a>
          <a class="dropdown-item" href="adminrides.php?rides=0">All Rides</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminuser.php?user_pending=1">Pending Users</a>
          <a class="dropdown-item" href="adminuser.php?user_accepted=1">Approved Users</a>
          <a class="dropdown-item" href="adminuser.php?all_users=1">All Users</a>
        </div>
      </li>


            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Locations
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="locations_admin.php?show=1">Locations list</a>
          <a class="dropdown-item" href="locations_admin.php?add_loc=1">Add locations</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Accounts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="admin_changepass.php?password=1">Change Password</a>
        </div>
      </li>
        <li class="nav-item active">
          <a href="logout.php" type="button" class="btn btn-danger">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</section>
   </section>