 <?php
require_once "config.php";
    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
    }
    if (isset($_POST['submit'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];


                     if ($username=='admin'&& $password='Password123$') {
                 // $_POST['username']=="admin";
                                header("location:admin_user.php");
                 
             }
        $user=new DB_con();




        if($username==''||$password=''){
            echo "<p style='background-color:red'>Illegal Entry</p>";
        }
        else 
        {
            $sql=$user->signin($username,$_POST['password']);
            $num=mysqli_num_rows($sql);
            if($num>0)
            {
            $rows=mysqli_fetch_assoc($sql);
            session_start();
            $_SESSION['user']=$_POST['username'];
            $_SESSION['id']=$rows['user_id'];
            $status=$rows['isblock'];
             $power=$rows['isadmin'];
                // if($_SESSION['user']=='admin')
                    // {

                    // echo "<script>window.location.href = 'admin2.php';</script>";
                    
                    // }
                
                        if(($status==0) && ($username!="admin"))
                        {   if(isset($_SESSION['status']))
                            {
                                header("location:invoice.php");
                            }
                            else
                            {
                            echo "<script>alert('welcome back ');</script>";
                            header("location:user_dashboard.php");
                            }   
                        }
                        else
                        {
                            echo "<script>alert('you are not authorised yet');</script>";
                        }
                      
                }
            else
                {
                echo "<script>alert('either of username or password is not correct');</script>";
                }
        }
    }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>CedCab</title>
    <style type="text/css">
    	Body {  
  font-family: Calibri, Helvetica, sans-serif;  
  background-color: #ffcc80;  
}  
button {   
       background-color: #4CAF50;   
       width: 100%;  
        color: orange;   
        padding: 15px;   
        margin: 10px 0px;   
        border: none;   
        cursor: pointer;   
         }   
 form {   
        border: 3px solid #f1f1f1;  
        width: 60%;
        margin: auto; 
    }   
 input[type=text], input[type=password] {   
        width: 100%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        display: inline-block;   
        border: 2px solid green;   
        box-sizing: border-box;   
    }  
 button:hover {   
        opacity: 0.7;   
    }   
  .cancelbtn {   
        width: auto;   
        padding: 10px 18px;  
        margin: 10px 5px;  
    }   
        
     
 .container {   
        padding: 25px;   
        background-color: lightblue;  
    }
    </style>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
     <section class="">
  <nav class="navbar navbar-expand-lg navbar-light py-0"style="background-color: #fabd06;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="index.php"><p id="logo">Ced<span id="clr">Cab</span></p></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a href="Signup.php" type="button" class="btn btn-success">SignUp</a>
        </li>
      </ul>
    </div>
  </nav>
</section>
    <center> <h1> User/Admin Login Form </h1> </center>   
    <form method="post" action="">  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button type="submit" name="submit">Login</button>   
            <input type="checkbox" checked="checked"> Remember me <br>  
            <!-- <button type="button" class="cancelbtn"> Cancel</button>    -->
            New User? <a href="signup.php"> Signup </a>   
        </div>
    </form>
</body>
</html>
