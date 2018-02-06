<?php

    require_once("config.php");
    
//Prevent the user visiting the logged in page if he/she is already logged in
if (isUserLoggedIn()) {
    header("Location: user_page.php");
    die();
}

if (isAdminLoggedIn()) {
    header("Location: admin_page.php");
    die();
}



//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    //Perform some validation

    if ($username == "") {
        $errors[] = "enter username";
    }
    if ($password == "") {
        $errors[] = "enter password";
    }

    if (count($errors) == 0) {
        //retrieve the records of the user who is trying to login
        $userdetails = fetchUserDetails($username);

        //See if the user's account is activated
        if ($userdetails["Active"] == 0) {
            $errors[] = "account inactive";
        } else {
            //Hash the password and use the salt from the database to compare the password.
            $entered_pass = generateHash($password, $userdetails["Password"]);

            if ($entered_pass != $userdetails["Password"]) {
                $errors[] = "invalid password";
            } else {
                //Passwords match! we're good to go'
                //Transfer some db data to the session object
                $loggedInUser = new loggedInUser();
                $loggedInUser->pincode = $userdetails["Pincode"];
                $loggedInUser->city = $userdetails["City"];
                $loggedInUser->mobnum = $userdetails["Mobnum"];
                $loggedInUser->email = $userdetails["Email"];
                $loggedInUser->user_id = $userdetails["UserID"];
                $loggedInUser->hash_pw = $userdetails["Password"];
                $loggedInUser->first_name = $userdetails["FirstName"];
                $loggedInUser->last_name = $userdetails["LastName"];
                $loggedInUser->username = $userdetails["UserName"];
                $loggedInUser->member_since = $userdetails["MemberSince"];

                //pass the values of $loggedInUser into the session -
                // you can directly pass the values into the array as well.

                $_SESSION["ThisUser"] = $loggedInUser;

                //now that a session for this user is created
                //Redirect to this users account page
                header("Location: user_page.php");
                die();
            }
        }

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
    <h3>Login Interface</h3>
     <?php 
        if(count($errors) <> 0){
        foreach($errors as $error){
            print_r($error); 
        }
    }
    ?>
  <form name="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">    
    <div class="row">
      <div class="col-25">
        <label for=username>UserName</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username">
      </div>
    
    
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password">
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