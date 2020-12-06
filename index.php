<?php 
session_start();
    
 ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>CedCab</title>
  <link rel="stylesheet" type="text/css" href="styleindex.css">
  <script type="text/javascript">
   $(document).ready(function(){
     $("#cabtype").change(function(){
      if ($(this).val()=="CedMicro") {
        $("#luggage").val("");
       $("#luggage").attr("disabled","enabled");
     }
     else if ($(this).val()!="CedMicro") {$("#luggage").removeAttr("disabled","enabled");}
   });
   });
 </script>
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
          <a href="#fbd" type="button" class="btn btn-warning b">Fare Breakdown</a>
        </li>
        <li class="nav-item active">
          <a href="login.php" type="button" class="btn btn-success">Login</a>
        </li>
      </ul>
    </div>
  </nav>
</section>
<div class="cover">
  <img class="img img-responsive" src="img/coverimage.jpeg">
  <div id="h">
   <p><b>Book a city Taxi to your destination in Town</b></p>
 </div>

 <div class="container">
   <div class="row">
     <div class="col-sm">
      <div class="card text-center">
       <div class="card-header">
        Calculate Fare
      </div>
      <div class="card-body">
        <h5 class="card-title"><span id="spanbg">City Taxi</span></h5>
        <p class="card-text">Your Everyday Partner.</p>
        <form method="POST">
          <div class="form-group" style="color:grey;width: auto;">

            <select class="form-control bg-quote" name="pickup" id="pickup">
             <option value="" disabled selected>PICKUP</option>
                  <?php 
                  require_once "location.php";
                    $u= new Location();
                    $s=$u->loc_user();
                    while($rows=$s->fetch_assoc())
                    {
                      echo "<option value='".$rows['name']."'>".$rows['name']."</option>";
                    }

                  ?>
           </select>

         </div>
         <div class="form-group">
          <select class="form-control bg-quote" name="drop" id="drop">
           <option value="" disabled selected>DROP</option>
                  <?php
                  $s=$u->loc_user();
                  while($rows=$s->fetch_assoc())
                    {
                      echo "<option value='".$rows['name']."'>".$rows['name']."</option>";
                    }
                    ?>
         </select>
       </div>
       <div class="form-group ui-select">

        <select class="form-control bg-quote" name="type" id="cabtype">
         <option value="" disabled selected>CAB TYPE</option>
         <option value="CedMicro">CedMicro</option>
         <option value="CedMini">CedMini</option>
         <option value="CedRoyal">CedRoyal</option>
         <option value="CedSUV">CedSUV</option>
       </select>

     </div>
     <div class="form-group">
       <div class="form-group mt-3">
        <input type="number" class="form-control" id="luggage" placeholder="Weight">
      </div>
      <div class="form-group mt-3">
        <input type="text" class="form-control" id="fare" disabled>
      </div>
    </div>
    <button type="submit" class="btn btn-warning btn-lg form-control mb-5" id="button">Calculate Fare</button>
    <a href="login.php" type="submit" class="btn btn-warning btn-lg form-control mb-5" id="bookbutton" onclick="log();">Book Cab</a>

  </form>
</div>
</div>
</div>
<div class="col-sm">

</div>
</div>
</div>
<section class="fbreak" id="fbd">
<div class="row">
  <div class="column">
    <div class="card">
      <h3>Ced Micro</h3>
      <img src="img/cedmicro.jpg" height="210px">
      <p><b>Base Price:</b>Rs 50</p>
      <p><b>First 10 KM:</b>Rs 13.50/km</p>
      <p><b>Next 50 KM:</b>Rs 12.00/km</p>
      <p><b>Next 100 KM:</b>Rs 10.20/km</p>
      <p><b>Further:</b>Rs 8.50/km</p>
      <p><b>Luggage:</b>N/A</p>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>Ced Mini</h3>
      <img src="img/cedmini.png" height="210px">
      <p><b>Base Price:</b>Rs 150</p>
      <p><b>First 10 KM:</b>Rs 14.50/km</p>
      <p><b>Next 50 KM:</b>Rs 13.00/km</p>
      <p><b>Next 100 KM:</b>Rs 14.00/km</p>
      <p><b>Further:</b>Rs 12.20/km</p>
      <p><b>Luggage:</b>Rs 50</p>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>Ced Royal</h3>
      <img src="img/cedroyal.jpg" height="210px">
      <p><b>Base Price:</b>Rs 200</p>
      <p><b>First 10 KM:</b>Rs 15.50/km</p>
      <p><b>Next 50 KM:</b>Rs 14.00/km</p>
      <p><b>Next 100 KM:</b>Rs 12.20/km</p>
      <p><b>Further:</b>Rs 10.50/km</p>
      <p><b>Luggage:</b>Rs 50</p>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>Ced SUV</h3>
      <img src="img/cedsuv.jpg" height="210px">
      <p><b>Base Price:</b>Rs 250</p>
      <p><b>First 10 KM:</b>Rs 16.50/km</p>
      <p><b>Next 50 KM:</b>Rs 15.00/km</p>
      <p><b>Next 100 KM:</b>Rs 13.20/km</p>
      <p><b>Further:</b>Rs 11.50/km</p>
      <p><b>Luggage:</b>Rs 100</p>
    </div>
  </div>
</div>
</section>
<?php require "footer.php"; ?>


</body>
</html>
<script>
  $(document).ready(function(){
    $('#fare').hide();
    $('#bookbutton').hide();
    $('#button').click(function(e){
     e.preventDefault();
     if($('#pickup').val()==null){
      alert("Select Pickup Value");
      return;
    }
    else{
      var pickup=$('#pickup').val();
    }
    if($('#drop').val()==null){
      alert("Select Drop Value");
      return;
    }
    var drop=$('#drop').val();
    if (drop==pickup) {
     alert("Pickup and drop value is same");
     return;
   }
   if($('#cabtype').val()==null){
    alert("Select CabType");
    return;
  }
  var cabtype=$('#cabtype').val();
  if ($('#luggage').val()==null || $('#luggage').val()<0) {
   alert("Illegal Value of weight");
   return;
 }
 if ($('#luggage').val()==0) {
   var luggage=0;
 }
 if ($('#luggage').val()>0 &&  $('#luggage').val()<=10) {
   var luggage=50;
 }
 if ($('#luggage').val()>10 && $('#luggage').val()<=20) {
   var luggage=100;
 }
 if ($('#luggage').val()>20) {
   var luggage=200;
 }

 $.ajax({
  url:'actionindex.php',
  type:'POST',
  data:{pickup:pickup,drop:drop,cabtype:cabtype,luggage:luggage
  },
  success:function(result){
    console.log(result);
    $('#fare').show();
    $('#fare').val("Total Fare:Rs"+result);
    $('#button').hide();
    $('#bookbutton').show();
    setTimeout(function(){ window.location.reload(); }, 5000);
  },
  error: function(){
    alert("error");
  }
});
});
  });
  function log(){
    alert("You Need To Login First");
  }
</script>
