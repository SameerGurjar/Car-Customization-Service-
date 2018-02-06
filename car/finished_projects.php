<?php
    require_once("config.php");
    require_once("header.php");
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="contact.php">Contact</a>
  <a href="about.php" >About</a>
  <a href="finished_projects.php" class="active">Our Projects</a>
    <a href="logins.php">Admin Login</a>  
    
  <?php include("topnav.php"); ?>
</div>

<!--Top Nav End -->


<?php 
    
    $allCarDetails = getAllCarDetails();
    
    if($allCarDetails == 0){
        echo '<center><h2>There are no current projects</h2></center>';
    }
  else {
       
    foreach ($allCarDetails as $carDetail){   
        
   echo '<br><div style="border-style: solid; border-color:white; color: white;
    border-width: 3px; margin: 10px 300px; padding: 10px;">' ;
        
    

        $user_id = $carDetail['UserID'];
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
                                    echo "<center><img src='uploads/".$name."' height='200' width='200'>&nbsp; &nbsp; &nbsp;";
                                    
                                   
                                }
                            
                        }
                    }
        
                    
        $finished_imageDisplay = finished_fetchCarImage($user_id);
        
                    $finished_destination_folder = $currentfolder . '/finished_uploads/'; //upload directory ends with / (slash)
                    
        
                    $finished_dir = $finished_destination_folder;


                    if (file_exists($finished_dir) == false) {
                        echo 'Directory "', $finished_dir, '" not found!';
                    } else {

                        $finished_dir_contents = scandir($finished_dir);
                   

                    }
                    foreach ($finished_dir_contents as $file) {
                        
                        $s = explode('.', $file);
                        $file_type = strtolower(end($s));
                        
                        if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
                            
                                if ($file == $finished_imageDisplay['newfilename']) {
                                    $name = basename($file);
                                    $imageid = $finished_imageDisplay['fileid'];
                                    echo "<img src='finished_uploads/".$name."' height='200' width='200'>&nbsp; &nbsp; &nbsp;</center>";
                                    
                                   
                                }
                            
                        }
                    }
        
        echo '<br><center><strong>';   
            echo $carDetail['Maker'].'<br>';
            echo $carDetail['Model'].'<br>';
        echo '</strong></ center>';   

                    

    echo '</div> <br>';            
    }
  }
    ?>

    
<!--Footer-->

<div class="footer">
  <p>Copyright</p>
</div>

<!--Footer End-->

</body>
</html>
