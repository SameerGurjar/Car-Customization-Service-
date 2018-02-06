<?php


function getUniqueCode($length = "")
{
    $code = md5(uniqid(rand(), TRUE));
    if ($length != "") {
        return substr($code, 0, $length);
    } else {
        return $code;
    }
}



function generateHash($plainText, $salt = NULL)
{
   
    if ($salt === NULL) {
        $salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
      
    } else {
        
        $salt = substr($salt, 0, 25);
       
    }
   

    return $salt . sha1($salt . $plainText);
}


// Admin creation
function createNewAdmin($username, $firstname, $lastname, $email, $password)
{
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range('a', 'z'), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }


    $newpassword = generateHash($password);

    echo $newpassword;


    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "AdminDetails (
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        1
		)"
    );
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $newpassword);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}


// fetch admin details
function fetchAdminDetails($username)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active
		FROM " . $db_table_prefix . "AdminDetails
		WHERE
		UserName = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $MemberSince, $Active);
    while ($stmt->fetch()) {
        $row = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active);
    }
    $stmt->close();
    return ($row);
}


// fetch all admin
function fetchAllAdmins()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active
		FROM " . $db_table_prefix . "AdminDetails
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active
        );
    }
    $stmt->close();
    return ($row);
}


// check admin logged in
function isAdminLoggedIn()
{
    global $loggedInAdmin, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UserID,
		Password
		FROM " . $db_table_prefix . "AdminDetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("ss", $loggedInAdmin->user_id, $loggedInAdmin->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInAdmin == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("ThisAdmin");
            return false;
        }
    }
}


// user creation
function createNewUser($username, $firstname, $lastname, $email, $pincode, $city, $mobnum, $password)
{
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range('a', 'z'), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }


    $newpassword = generateHash($password);

    echo $newpassword;


    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "UserDetails (
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
        Pincode,
        City,
        Mobnum,
		Password,
		MemberSince,
		Active
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
        ?,
        ?,
        ?,
        '" . time() . "',
        1
		)"
    );
    $stmt->bind_param("ssssssss", $username, $firstname, $lastname, $email, $pincode, $city, $mobnum, $newpassword);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}

// user fetch detail
function fetchUserDetails($username)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
        Pincode,
        City,
        Mobnum,
		Password,
		MemberSince,
		Active
		FROM " . $db_table_prefix . "UserDetails
		WHERE
		UserName = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Pincode, $City, $Mobnum, $Password, $MemberSince, $Active);
    while ($stmt->fetch()) {
        $row = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Pincode' => $Pincode,
            'City' => $City,
            'Mobnum' => $Mobnum,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active);
    }
    $stmt->close();
    return ($row);
}


//Check if a user is logged in
/**
 * @return bool
 */
function isUserLoggedIn()
{
    global $loggedInAdmin, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UserID,
		Password
		FROM " . $db_table_prefix . "UserDetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("ss", $loggedInUser->user_id, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("ThisUser");
            return false;
        }
    }
}


//Destroys a session as part of logout
/**
 * @param $name
 */
function destroySession($name)
{
    if (isset($_SESSION[$name])) {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}


//Retrieve complete user information of all users
/**
 * @return array
 */
function fetchAllUsers()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
        Pincode,
        City,
        Mobnum,
		Password,
		MemberSince,
		Active
		FROM " . $db_table_prefix . "UserDetails
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Pincode, 
        $City, 
        $Mobnum,
        $Password,
        $MemberSince,
        $Active
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Pincode' => $Pincode,
            'City' => $City,
            'Mobnum' => $Mobnum,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active
        );
    }
    $stmt->close();
    return ($row);
}

// add car details



function createCarDetails($maker, $model, $sub_model, $year, $description)
{
   global $mysqli, $db_table_prefix, $loggedInUser;
    

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "car_detail (
		UserId,
		Maker,
        Model,
		Sub_Model,
        Year,
		Description
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
        ?
		)"
    );
    $stmt->bind_param("ssssss", $loggedInUser->user_id, $maker, $model, $sub_model, $year, $description);
    print_r($loggedInUser->user_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}


function getCarDetail($user_id){
    global $loggedInUser, $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		Maker,
		Model,
		Sub_model,
		Year,
		Description
		FROM " . $db_table_prefix . "car_detail 
		WHERE
		UserID = ?
		LIMIT 1");
    $stmt->bind_param("s", $user_id);

    $stmt->execute();
    $stmt->bind_result($Maker, $Model, $Sub_model, $Year, $Description);
    while ($stmt->fetch()) {
        $row = array('Maker' => $Maker,
            'Model' => $Model,         
            'Sub_model' => $Sub_model,
            'Year' => $Year,
            'Description' => $Description);
    }
    $stmt->close();
    return ($row);
}


function fetchCarImage($user_id){
  global $loggedInUser, $mysqli,$db_table_prefix;
  $stmt = $mysqli->prepare("SELECT
  file_ID,
  user_id,
  new_file_name
  FROM ".$db_table_prefix."filesRepository
  WHERE user_id = ? 
  LIMIT 1"                          );
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $stmt->bind_result($file_id, $user_id, $new_file_name);
  while ($stmt->fetch()){
    $row = array('fileid' => $file_id,
                   'userid' => $user_id,
                   'newfilename' => $new_file_name);
  }
  $stmt->close();
  return ($row);
}



function deleteUser(){
    
    global $mysqli, $db_table_prefix, $loggedInUser;
    $stmt = $mysqli->prepare("DELETE
		FROM " . $db_table_prefix . "userdetails
        WHERE UserID = ?"
        );
 
    $stmt->bind_param('s', $loggedInUser->user_id);
    $result = $stmt->execute();
    $stmt->close();
    
    if($result){
        destroySession("ThisUser");
        return 1;
    }
    return 0;
    
}



function getAllCarDetails()
{

    global $loggedInUser, $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
        UserID,
		Maker,
		Model,
		Sub_model,
		Year,
		Description
		FROM " . $db_table_prefix . "car_detail 
		");

    $result = $stmt->execute();
    $stmt->bind_result($UserID, $Maker, $Model, $Sub_model, $Year, $Description);
    while ($stmt->fetch()) {
        $row[] = array('UserID' => $UserID,
            'Maker' => $Maker,
            'Model' => $Model,         
            'Sub_model' => $Sub_model,
            'Year' => $Year,
            'Description' => $Description);
    }
    $stmt->close();
    if($result <> 0){
        return 0; }
    else{
        return $row;
    }
}



function finished_fetchCarImage($user_id){
      global $loggedInUser, $mysqli,$db_table_prefix;
  $stmt = $mysqli->prepare("SELECT
  file_ID,
  user_id,
  new_file_name
  FROM ".$db_table_prefix."finished_filesRepository
  WHERE user_id = ? 
  LIMIT 1"                          );
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $stmt->bind_result($file_id, $user_id, $new_file_name);
  while ($stmt->fetch()){
    $row = array('fileid' => $file_id,
                   'userid' => $user_id,
                   'newfilename' => $new_file_name);
  }
  $stmt->close();
  return ($row);
    
}
