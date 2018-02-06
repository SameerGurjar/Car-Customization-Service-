<?php
    require_once("config.php");


//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $maker = trim($_POST["maker"]);
    $model = trim($_POST["model"]);
    $sub_model = trim($_POST["sub_model"]);
    $year = trim($_POST["year"]);
    $description = trim($_POST["description"]);

    

    //End data validation
    if (count($errors) == 0) {
        $user = createCarDetails($maker, $model, $sub_model, $year, $description);
        if ($user <> 1) {
            $errors[] = "registration error";
        }
    }
    if (count($errors) == 0) {
        header("Location:upload_images.php");
    }
}

    require_once("header.php");
    
?>


<body>

	<!--Top Nav -->

    
<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="contact.php">Contact</a>
  <a href="about.php" >About</a>
 

</div>
  

<!--Top Nav End -->




<!--form-->
<center>
        <?php 
        if(count($errors) <> 0){
        foreach($errors as $error){
            print_r($error); 
        }
    }
    ?>

<div class="container">
    <strong>Car Details</strong>
  <form name="customize" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="row">
      <div class="col-25">
        <label for=maker>Maker</label>
      </div>
      <div class="col-75">
        <input type="text" id="maker" name="maker" placeholder="Maker...">
      </div>
    
    
      <div class="col-25">
        <label for="model">Model</label>
      </div>
      <div class="col-75">
        <input type="text" id="model" name="model" placeholder="Model...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="sub_model">Sub Model</label>
      </div>
      <div class="col-75">
        <input type="text" id="sub_model" name="sub_model" placeholder="Sub Model...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="year">Year</label>
      </div>
      <div class="col-75">
        <input type="number" id="year" name="year" placeholder="Year...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="description">Description or Engine Details</label>
      </div>
      <div class="col-75">
        <textarea id="description" name="description" placeholder="Write something.."></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

</center>
<!--form end-->

<!--Footer-->

<div class="footer">
  <p>Copyright</p>
</div>

<!--Footer End-->


</body>
</html>