<?php
    require_once("config.php");
    require_once("header.php");
    
    if (!isUserLoggedIn()) {
    header("Location: car.php");
    die();
}
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="contact.php">Contact</a>
  <a href="about.php">About</a>
    
  <?php include("topnav.php"); ?>
</div>

<!--Top Nav End -->
<h2>Hello <?php echo $loggedInUser->first_name; ?></h2>
Welcome to our customization shop...please select car details to feed nessecary details    
    
<center>
<a class="cust_link" href="customize.php"><button class="button"><span>FeedDetails</span></button></a>
<a class="cust_link" href="user_car_detail.php"><button class="button1"><span>Process</span></button></a>
</center>

<!--Footer-->

<div class="footer">
  <p>Footer</p>
</div>

<!--Footer End-->

</body>
</html>
