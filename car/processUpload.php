<?php

require_once("config.php");


############ Configuration ##############
//$destination_folder		= 'G:/path/to/uploads/folder/'; //upload directory ends with / (slash)
$currentfolder = getcwd();
echo $currentfolder;
$destination_folder = $currentfolder . '/uploads/'; //upload directory ends with / (slash)
echo $destination_folder;
define("UPLOAD_DIR", $destination_folder);

##########################################

// check $_FILES[''] not empty
if (!isset($_FILES['galleryImage']) || !is_uploaded_file($_FILES['galleryImage']['tmp_name']) || $_FILES['galleryImage']['error'] > 0) {

//  $errors = lang("FILE MISSING"); // output error when above checks fail.
//  header("Location: ".$baseURL."/myaccount.php?er=fm"); /* Redirect browser */
  exit();

}
else {
  $file_name = $_FILES['galleryImage']['name'];
  $file_size = $_FILES['galleryImage']['size'];
  $file_tmp = $_FILES['galleryImage']['tmp_name'];
  $file_type = $_FILES['galleryImage']['type'];
  $file_error = $_FILES['galleryImage']['error'];

  //$file_ext=strtolower(end(explode('.',$file_name)));
  $path_parts = pathinfo($file_name);

  $file_basename =  strtolower($path_parts['basename']);
  $file_name_new= strtolower($path_parts['filename']);
  $file_ext=strtolower($path_parts['extension']);


  $extensions = array("png","jpeg","gif","bmp","jpg");

  if(in_array($file_ext,$extensions )=== false){
    $errors[]="extension not allowed, please choose a .";
//    header("Location: ".$baseURL."/myaccount.php?er=ex"); /* Redirect browser */
    exit();

  }
  if($file_size > 2097152){
    $errors[]='File size must not be greater than 2MB';
//    header("Location: ".$baseURL."/myaccount.php?er=lg"); /* Redirect browser */
    exit();

  }

  if ($file_error !== UPLOAD_ERR_OK) {
    $errors[]='an error occurred';
 //   header("Location: ".$baseURL."/myaccount.php?er=ue"); /* Redirect browser */
    exit();

  }

  $character_array = array_merge(range('a', 'z'), range(0, 99));
  $rand_string = "";
  for ($i = 0; $i < 9; $i++) {
    $rand_string .= $character_array[rand(0, (count($character_array) - 1))];
  }

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  // ensure a safe filename
  $name = preg_replace("/[^A-Z0-9._-]/i", "_", $file_name_new);

  //create a random name for new image (Eg: fileName_293749.jpg) ;
  $new_file_name = $name . '_' . rand(0, 100) . '.' . $file_ext;

  if(empty($errors)==true) {
    //preserve file from temporary directory
    $success = move_uploaded_file($file_tmp, UPLOAD_DIR . $new_file_name);
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $new_file_name, 0644);
    if (!$success) {
      $errors[] = 'unable to save file';
//      header("Location: ".$baseURL."/myaccount.php?er=usf"); /* Redirect browser */
      exit();
    }

  }
  else{
     print_r($errors);
//    header("Location: ".$baseURL."/myaccount.php?er=e"); /* Redirect browser */
    exit();

  }



}


 $actual_url = "$base_URL/viewImage.php?rid=$rand_string";
//echo $actual_url;
$deleteFlag = "0";

### Update database.

$stmt = "INSERT INTO " . $db_table_prefix . "filesRepository (
        file_ID,
        user_id,
        current_folder,
        destination_folder,
        new_file_name,
        file_save_folder,
        file_type,
        file_temp,
        file_size,
        file_extension,
        file_name,
        actual_url,
        IPADDRESS,
        deleteflag
        )
        VALUES (
        '" . $rand_string . "',
        '" . $loggedInUser->user_id . "',
        '" . $currentfolder . "',
        '" . $destination_folder . "',
        '" . $new_file_name . "',
        '"  .UPLOAD_DIR . "',
        '" . $file_type . "',
        '" . $file_tmp . "',
        '" . $file_size . "',
        '" . $file_ext . "',
        '" . $file_name_new . "',
        '" . $actual_url . "',
        '" . $ip . "',
        '" . $deleteFlag . "'
        )";

if (mysqli_query($mysqli, $stmt)) {
  echo "New record created successfully";

} else {
  echo "Error: " . $stmt . "<br>" . mysqli_error($mysqli);
 // header("Location: ".$baseURL."/myaccount.php?er=e"); /* Redirect browser */
  exit();
}


header("Location: finish.php"); /* Redirect browser */
exit();

?>
}