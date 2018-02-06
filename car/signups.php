<?php


//Prevent the user visiting the logged in page if he/she is already logged in
if (isUserLoggedIn()) {
    header("Location: myaccount.php");
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

    if ($password == "") {
        $errors[] = "enter valid password";
    }

    if ($confirm_pass == "") {
        $errors[] = "enter valid password";
    }

    if ($email == "") {
        $errors[] = "enter valid email address";
    }


    if ($password == "" && $confirm_pass == "") {
        $errors[] = "enter password";
    } else if ($password != $confirm_pass) {
        $errors[] = "password do not match";
    }

    //End data validation
    if (count($errors) == 0) {
        $user = createNewUser($username, $firstname, $lastname, $email, $password);
        print_r($user);
        if ($user <> 1) {
            $errors[] = "registration error";
        }
    }
    if (count($errors) == 0) {
        header("Location: car.php");
    }
}


?>


<div>
<form class="modal-content animate" name="newUser" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">    

   <div class="imgcontainer">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  </div>

    <div class="container">
      
      <label><b>User Name</b></label>
      <input type="text" name="username" required>
        
        <label><b>firstname</b></label>
      <input type="text" name="firstname" required>
        
        <label><b>Last Name</b></label>
      <input type="text" name="lastname" required>
        
        <label><b>Email</b></label>
      <input type="text" name="email" required>

      <label><b>Password</b></label>
      <input type="password" name="password" required>

      <label><b>Repeat Password</b></label>
      <input type="password" name="passwordc" required>
    

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" style="">Sign Up</button>
      </div>
    </div>
  </form>
</div>