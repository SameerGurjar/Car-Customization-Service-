<?php
    require_once("config.php");
    require_once("header.php");

    $user_id = $_GET['userId'];
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="logout.php">Logout</a>

</div>

<!--Top Nav End -->

<?php 
    
        $userDetails = getUserDetails($user_id);
        $carDetails = getCarDetail($user_id);
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
                                    echo "<center><img src='uploads/".$name."' height='400' width='400'>&nbsp; &nbsp; &nbsp;<center>";
                                    
                                   
                                }
                            
                        }
                    }  ?>
    
                     
        <div style="border-style: solid; border-width: 3px; margin: 10px 400px; border-color: white; color:white;">
        <h3>User Details</h3>
        <table>
            <tr><strong>Name :</strong> <?php echo $userDetails['Name']; ?></tr><br>
            <tr><strong>Address Line 1 :</strong> <?php echo $userDetails['Addr1']; ?></tr><br>
            <tr><strong>Address Line 2 :</strong> <?php echo $userDetails['Addr2']; ?></tr><br>
            <tr><strong>Landmark :</strong> <?php echo $userDetails['Landmark']; ?></tr><br>
            <tr><strong>Pincode :</strong> <?php echo $userDetails['Pincode']; ?></tr><br>
            <tr><strong>State :</strong> <?php echo $userDetails['State']; ?></tr><br>
            <tr><strong>Mobnum :</strong> <?php echo $userDetails['Mobnum']; ?></tr><br>
        </table>
    </div>
    <div style="border-style: solid; border-width: 3px; margin: 10px 400px; border-color: white; color:white;">
        <h3>Car Details</h3>
        <table>
            <tr><strong>Maker :</strong> <?php echo $carDetails['Maker']; ?></tr><br>
            <tr><strong>Model :</strong> <?php echo $carDetails['Model']; ?></tr><br>
            <tr><strong>Sub Model :</strong> <?php echo $carDetails['Sub_model']; ?></tr><br>
            <tr><strong>Year :</strong> <?php echo $carDetails['Year']; ?></tr><br>
            <tr><strong>Description :</strong> <?php echo $carDetails['Description']; ?></tr><br>
        </table>
    </div>    
    
    <a href="admin_finish.php?userId=<?php echo $user_id; ?>"><button>Upload Finished Image</button></a>


<!--Footer-->

<!--Footer End-->

</body>
</html>
