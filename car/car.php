<?php
    require_once("config.php");
    require_once("header.php");
    
    if(isAdminLoggedIn()){
        header('Location: admin_page.php');
        die();
    }
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php" class="active">Home</a>
  <a href="contact.php">Contact</a>
  <a href="about.php" >About</a>
  <a href="finished_projects.php" >Our Projects</a>
  <a href="logins.php">Admin Login</a>
</div>

<!--Top Nav End -->

<!--Customize Button-->


<center>
<h2 style="color:white;">We can Customize your car....please provide us your details and we will reach you</h2> 
<a class="cust_link" href="user_detail.php"><button class="button"><span>FeedDetails</span></button></a>
</center>

<!--Customize Button End-->






    
    
<!--Footer-->

<div class="footer">
  <p>Copyright</p>
</div>

<!--Footer End-->

</body>
</html>
