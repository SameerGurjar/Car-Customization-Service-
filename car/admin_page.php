<?php
    require_once("config.php");
    require_once("header.php");

    
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="logout.php">Logout</a>

</div>

<!--Top Nav End -->

<?php 
    
    $allUserDetails = getAllUserDetails();
    
    if($allUserDetails == 0){
        echo '<center><h2>There are no requests</h2></center>';
    }
  else {
       
    foreach ($allUserDetails as $userDetail){   
        
   echo '<br><div style="border-style: solid; border-color: white;
    border-width: 3px; margin: 10px 500px; padding: 10px; color:white;">' ;
        
    

        $user_id = $userDetail['UserID'];
        $carDetail = getCarDetail($user_id);
        $imageDisplay = fetchCarImage($user_id);
        
            
                    $currentfolder = getcwd();
                    $destination_folder = $currentfolder . '/uploads/'; //upload directory ends with / (slash)

                    $dir = $destination_folder;

                    $file_display = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

                    if (file_exists($dir) == false) {
                        echo 'Directory "', $dir, '" not found!';
                    } else {

                        $dir_contents = scandir($dir);
                   

                    }
                    foreach ($dir_contents as $file) {
                        
                        $s = explode('.', $file);
                        $file_type = strtolower(end($s));
                        
                        if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
                            
                                if ($file == $imageDisplay['newfilename']) {
                                    $name = basename($file);
                                    $imageid = $imageDisplay['fileid'];
                                    echo "<center><img src='uploads/".$name."' height='150' width='150'>&nbsp; &nbsp; &nbsp;<center>";
                                    
                                   
                                }
                            
                        }
                    }
        
            echo $userDetail['Name'].'<br>';
            echo $carDetail['Maker'].'<br>';
            echo $carDetail['Model'].'<br>';
            echo '
                <a style= "
                background-color: #f44336;
                color: white;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;"
                href="delete.php?userId='. $user_id .'">
                Delete
                </a>
                
                <a style= "
                background-color: #f44336;
                color: white;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;"
                href="admin_user_car_detail.php?userId='. $user_id .'">
                View Details
                </a>
            ';

                    

    echo '</div> <br>';            
    }
  }
    ?>

    
    


<!--Footer-->

<!--Footer End-->

</body>
</html>
