<?php
    require_once("config.php");
    require_once("header.php");
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


<!--LOGIN-->

<div id="id01" class="modal">
  
  <?php include("logins.php"); ?>
</div>

<!--LOGIN End-->

<!--Signup-->



<div id="id02" class="modal">
  
 <?php include("signups.php"); ?>
</div>


<!--Signup End-->

<!--Footer-->

<div class="footer">
  <p>Footer</p>
</div>

<!--Footer End-->

</body>
</html>





<?php
    require_once("config.php");
    require_once("header.php");
?>


<body>
<div id="wrapper">
    <div id="content">
        <h2>My Account</h2>
        
        <div id="main">
            <br><br><br>
            Hey, <?php echo "$loggedInUser->first_name" . "$loggedInUser->last_name"; ?>.
            This is an example page designed to demonstrate user authentication examples.
            Just so you know, you registered this account on <?php print date("M d, Y", $loggedInUser->member_since); ?>

            <?php print $loggedInUser->email; ?>
        </div>
        <div id='bottom'></div>
        <a href='logout.php'>Logout</a>
    </div>
</div>
</body>
</html>