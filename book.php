<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<title> Shuttle Cab Management System </title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2018.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
.detail
{
	height:500px;
}

#pholder {
	max-height: 100px;
	max-width: 100px;
}

.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.wrapper {
	text-align: center;
}

#darshan {
  height: 500px;
  padding-top: 50px;
}

#footer {
  background-color: #e3f2fd;
   height: 50px;
    font-family: 'Verdana', sans-serif;
    padding: 20px;
}

#photo {
  max-height: 400px;
  max-width: 250px;
  padding-top: 20px;
  padding-left: 20px;
}
</style>
</head>
<body style="background-color: powderblue;">
<!--header-->
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <div class= "navbar-header">
        <button type= "button" class="navbar-toggle" data-toggle= "collapse" data-target= "#bs-safar-navbar-collapse-1">
          <span class= "sr-only"> Toggle navigation </span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
         </button>
      <a class="navbar-brand" href="#"> Shuttle Cab Management System</a>
    </div>
  <div class= "collapse navbar-collapse navbar-right" id="bs-safar-navbar-collapse-1">
    <ul class= "nav navbar-nav">
      <li> <a href="./first_page.php"> Home </a> </li>
      <li> <a href="#"> About </a> </li>
	  <li> <a href="./homepage_safar.php"> Logout </a> </li>
    </ul>
    </div>  
  </div>
</nav>
<!--end of navbar-->
<!--generic info-->
<div class= "container-fluid">
 <div class= "col-md-4" >
  <div class= "panel panel-info" id="info" >
      <div class= "panel-heading">
        <h4 class= "panel-title" align="center"> Student Information </h4>
      </div> 
<?php 
//$_SESSION['logged_user']=1;
$server="localhost";
$username="root";
$password="";
$db="safar";
$t= $_SESSION['logged_user'];
$conn = new mysqli($server,$username,$password,$db);
if($conn->connect_error){
    die("Connection failed".mysqli_connect_error());
}
  $result= $conn->query ("SELECT * FROM customer where cid = '$t'");
  $row = $result->fetch_assoc();
  $result1= $conn->query ("SELECT * FROM ride_details where cid = '$t' ORDER BY rid DESC LIMIT 1");
  $row1 = $result1->fetch_assoc();
  //echo mysqli_num_rows($result1);
  /*if (mysqli_num_rows($result)>0)
  {
    $count= mysqli_num_rows($result);
  }
 while($row = $res1->fetch_assoc()) 
{*/

  $n = $row['name'];
  $e = $row['email'];
  $l = $row['locality'];
  $g = $row['gender'];
  $f = $row['newname'];
  $s = "";
  $d = "";
  if (mysqli_num_rows($result1)==0) {
    $s = "No trips";
    $d = " yet";
  }
  else {
    $s = $row1['source'];
    $s .= " to ";
    $d = $row1['destination'];
  }
//mysqli_close($conn);

?>
    <div class= "panel panel-body detail">
      <img id="pholder" class= "center" src="./images/placeholder.png">
      <br>
      <br>
      <table class = "table">
      <tr>
         <td align="center">Reg No: <?php echo "$n"; ?></td>
      </tr>
      
      <tr>
          <td align="center">Name: <?php echo "$f"; ?></td>
      </tr>

      <tr>
         <td align="center">E-mail: <?php echo "$e"; ?></td>
      </tr>
      
      <tr>
         <td align="center">Gender: <?php echo "$g";?></td>
      </tr>

      <tr>
         <td align="center">Latest Trip: <?php echo $s . $d; mysqli_close ($conn);?></td>
      </tr>
   </table>
   <br>
   <br>
   <div class= "wrapper">
   <button class= "btn btn-success" name="book" align= "center"> Book a Cab </button> 
   </div>

      </div>
    </div>
  </div>
<!-- end of generic info-->
 <div class="col-md-4" align="center">
      <div class= "bg-light text-dark">
  
    <div class= "panel panel-info">
      <div class= "panel-heading">
        <h4 class= "panel-title"> Book a Shuttle </h4>
      </div> 

    <div class= "panel panel-body" id="darshan">
<form id="form1" action="#" method="POST">
    <div class="form-group has-feedback">
    <label for="source">Source:</label>
    <input type="text" class="form-control" id= "source" name="source" placeholder="source">
    <i class="glyphicon glyphicon-user form-control-feedback"></i>
</div>
  <div class="form-group has-feedback">
    <label for="destination">Destination:</label>
    <input type="text" class="form-control" id="destination" name="destination" placeholder="destination">
     <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
  </div>
  <h5><strong> Vehicle Type: </strong></h5>
   <div class="form-check">
      <label class="form-check-label" for="ac">
        <input type="radio" class="form-check-input" id="AC" name="mini" value="AC" checked>A/C Shuttle
      </label>
    </div>

    <div class="form-check">
      <label class="form-check-label" for="nonac">
        <input type="radio" class="form-check-input" id="nonAC" name="mini" value="nonAC">Non A/C Shuttle
      </label>
    </div>
     <div>
     <h5><strong> Payment Mode: </strong></h5>
     <div class="form-check">
      <label class="form-check-label" for="cash">
        <input type="radio" class="form-check-input" id="cash" name="credit" value="cash" checked>Cash
      </label>
    </div>

    <div class="form-check">
      <label class="form-check-label" for="credit">
        <input type="radio" class="form-check-input" id="credit" name="credit" value="credit">Credit Card
      </label>
    </div>
  </div>
  <button name="add" type="submit" value="add" class="btn btn-primary">Submit</button>

  <!--<button onclick="location.href='http://localhost/ShuttleCabmgmtsys/payment.php'" button name="payee" type="button" class="btn btn-success" value="gopay" >Pay Now</button>-->
  </form>
  </div>
</div>
</div>
</div>
<div class="col-md-4 w3-animate-top" align="center">
        <div class= "bg-light text-dark">
          <div class= "panel panel-success">
      <div class= "panel-heading">
        <h4 class= "panel-title"> Get Distance Estimate </h4>
      </div> 
   
    <div class= "panel-body">
<a href="./source-distance-finder-google-maps.html">To get distance estimate click here</a>
</div>
</div>
</div>
</div>

   <div class="col-md-12">
      <div class= "jumbotron" align="center">
        <h2> Features </h2>
      </div>
    </div>
      <!--carousel type content-->
</div>
<div class="container-fluid">
<div class="col-md-3">
<div class="w3-container w3-2018-sailor-blue w3-hover-black w3-animate-bottom" id="adv">
  <img id="photo" src="./images/money.jpg">	
  <h2>Easy credit transfer</h2>
  <p>Easily pay for your ride<br>&nbsp;</p>
</div>
</div>
<div class="col-md-3">
<div class="w3-container w3-2018-sailor-blue w3-hover-black w3-animate-bottom" id="adv">
  <img id="photo" src="./images/security.jpg">	
  <h2>Security</h2>
  <p>Safe and secure money transfer and travelling</p>
</div>
</div>
<div class="col-md-3" >
<div class="w3-container w3-2018-sailor-blue w3-hover-black w3-animate-bottom" id="adv">
  <img id="photo" src="./images/time.jpg">	
  <h2>Time management</h2>
  <p>Save your time with scheduled ride<br>&nbsp;</p>
</div>
</div>
</div>
 
   </div>
 <!--end of carousel type content-->
<!-- footer-->
<footer id="footer">
    <span class="pull-right"><strong>Version</strong> 1.0.0</span>
    <p><b>Submitted by: </b>19BCI0001, 19BCI0036</p>
    <P>A Project Under Prof : Kathiravan S</P>
</footer>


<?php


function randomName() {
    $names = array(
        'Gangadhar',
        'Raju',
        'Ismail',
        'Sukhpreet',
        'Ramesh',
        'Parshva',
        'Ninad',
        'Darshan',
        'Rushabh',
        'Nipun'
        // and so on

    );
    $random_name = $names[mt_rand(0, sizeof($names) - 1)];
    return $random_name;
}

if(isset($_POST['add']))
{
$fare= 15;
$driver= randomName();
$s= $_POST['source'];
$d= $_POST['destination'];
$m= $_POST['mini'];
$p= $_POST['credit'];
$server="localhost";
$username="root";
$password="";
$db="safar";
$conn = new mysqli($server,$username,$password,$db);
if($conn->connect_error){
    die("Connection failed".mysqli_connect_error());
}
else
{
/*echo 'successful';
echo $s;
echo $d;
echo $m;
echo $p;
echo $fare;
echo $driver;*/
$user= $_SESSION['logged_user'];
$conn->query ("INSERT INTO ride_details(cid,source,destination,p_mode,c_type,fare,dname,ride_time) VALUES ('$user','$s','$d','$p','$m','$fare','$driver',CURRENT_TIMESTAMP())");
mysqli_close($conn);
unset ($_POST['add']);
if ($p == "credit") {
  echo '<script>location.replace("payment_back.php");</script>';
}
else {
  echo '<script>location.replace("first_page.php");</script>';
}
}
}
 ?>
</body>
</html>