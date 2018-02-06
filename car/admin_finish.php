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


 <div class="row">
      
        <form name='uploadImage' action="admin_processUpload.php?userId=<?php echo $user_id; ?>" method='post' enctype='multipart/form-data'>
            <div>
            <label for="file_upload">File Upload</label>
        </div>
        <div>    
            <input type="file" name="galleryImage" id="file_upload"><br>
            <button type="submit">Upload Image</button>
        
      </div>
        </form>
    </div>

</body>
</html>
