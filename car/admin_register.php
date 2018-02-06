<?php

    require_once('config.php');

//Prevent the user visiting the logged in page if he/she is already logged in

if (isAdminLoggedIn()) {
    header("Location: admin_page.php");
    die();
}

if (isUserLoggedIn()) {
    header("Location: user_page.php");
    die();
}


//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);


    if ($username == "") {
        $errors[] = "enter valid username";
    }

    if ($firstname == "") {
        $errors[] = "enter valid first name";
    }

    if ($lastname == "") {
        $errors[] = "enter valid last name";
    }

    if ($email == "") {
        $errors[] = "enter valid email address";
    }


    if ($password == "" || $confirm_pass == "") {
        $errors[] = "enter password";
    } else if ($password != $confirm_pass) {
        $errors[] = "password do not match";
    }
    
    if(strlen($password) <= 4){
        $errors[] = "enter password greater than 5 character";
    }
        

    //End data validation
    if (count($errors) == 0) {
        $user = createNewAdmin($username, $firstname, $lastname, $email, $password);
        if ($user <> 1) {
            $errors[] = "registration error";
        }
    }
    if (count($errors) == 0) {
        header("Location: admin_login.php");
    }
}
    
    require_once('header.php');
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
    <h3>Register Interface</h3>
     <?php 
        if(count($errors) <> 0){
        foreach($errors as $error){
            print_r($error); 
        }
    }
    ?>
  <form name="user_register" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">   
      
    <div class="row">
      <div class="col-25">
        <label for=username>UserName</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username">
      </div>
    </div>    
        
    <div class="row">
      <div class="col-25">
        <label for=firstname>Firstname</label>
      </div>
      <div class="col-75">
        <input type="text" id="firstname" name="firstname">
      </div>
    </div>    
    
    <div class="row">
      <div class="col-25">
        <label for="lastname">Lastname</label>
      </div>
      <div class="col-75">
        <input type="text" id="lastname" name="lastname">
      </div>
    </div>
        
    <div class="row">
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email">
      </div>
    </div> 
        
    <div class="row">
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password">
      </div>
    </div> 
        
    <div class="row">
      <div class="col-25">
        <label for="passwordc">Confirm Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="passwordc" name="passwordc">
      </div>
    </div>     
    
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

</center>

<!-- Form ends -->

<!--Footer-->

<div class="footer">
  <p>Copyright</p>
</div>

<!--Footer End-->


</body>
</html>