<?php
    require_once("config.php");






//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $name = trim($_POST["name"]);
    $addr1 = trim($_POST["addr1"]);
    $addr2 = trim($_POST["addr2"]);
    $landmark = trim($_POST["landmark"]);
    $pincode = trim($_POST["pincode"]);
    $state = trim($_POST["state"]);
    $mobnum = trim($_POST["mobnum"]);

    // Validation starts
    
    if ($name == "") {
        $errors[] = "enter username";
    }
    if ($addr1 == "") {
        $errors[] = "enter address line 1";
    }
    
    if ($addr2 == "") {
        $errors[] = "enter address line 2";
    }
    
     if ($pincode == "" || !is_numeric($pincode)) {
        $errors[] = "enter valid pincode";
    }
    if ($mobnum == "" || strlen($mobnum) <> 10) {
        $errors[] = "enter valid Mobile Number";
    }
    
    
    

    //End data validation
    if (count($errors) == 0) {
        $user = createUserDetail($name, $addr1, $addr2, $landmark, $pincode, $state, $mobnum);
        print_r($user[0]);
        if ($user[0] <> 1) {
            $errors[] = "registration error";
        }
    }
    if (count($errors) == 0) {
        $User = new User();
        $User->userId = $user[1];
        $_SESSION["ThisUser"] = $User;
        header("Location:customize.php");
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

<div class="container">
    <strong>Car Details</strong>
    <?php 
        if(count($errors) <> 0){
        foreach($errors as $error){
            print_r($error);
            echo '<br>';
        }
    }
    ?>
  <form name="userdetail" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      
    <div class="row">
      <div class="col-25">
        <label for=name>Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name">
      </div>
    
    </div>
    <div class="row">  
      <div class="col-25">
        <label for="addr1">Address Line 1</label>
      </div>
      <div class="col-75">
        <input type="text" id="addr1" name="addr1">
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="addr2">Address Line 2</label>
      </div>
      <div class="col-75">
        <input type="text" id="addr2" name="addr2">
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="landmark">Landmark (Optional)</label>
      </div>
      <div class="col-75">
        <input type="text" id="landmark" name="landmark">
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="pincode">Pincode</label>
      </div>
      <div class="col-75">
        <input type="text" id="pincode" name="pincode">
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="state">State</label>
      </div>
      <div class="col-75">
        <select name="state">
        <option value="California">California</option>
        <option value="Delaware">Delaware</option>
        <option value="Florida">Florida</option>
        <option value="Georgia">Georgia</option>
        <option value="New York">New York</option>
        <option value="Ohio">Ohio</option>
        <option value="Texas">Texas</option>
        <option value="Washington">Washington</option>
        </select>
      </div>
    </div>
      
    <div class="row">
      <div class="col-25">
        <label for="mobnum">Mobile No.</label>
      </div>
      <div class="col-75">
        <input type="text" id="mobnum" name="mobnum">
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
  <p>Footer</p>
</div>

<!--Footer End-->


</body>
</html>