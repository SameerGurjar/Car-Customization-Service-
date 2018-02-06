<?php
    require_once("config.php");
    require_once("header.php");

    
?>

<body>

<!--Top Nav -->

<div class="topnav" id="myTopnav">
  <a href="car.php">Home</a>
  <a href="contact.php" class="active">Contact</a>
  <a href="about.php">About</a>

</div>

<!--Top Nav End -->


 <div class="row">
      
        <form name='uploadImage' action='processUpload.php' method='post' enctype='multipart/form-data'>
            <div>
            <label for="file_upload">File Upload</label>
        </div>
        <div>    
            <input type="file" name="galleryImage" id="file_upload"><br>
            <button type="submit">Upload Image</button>
        
      </div>
        </form>
    </div>

<!--Footer-->

<div class="footer">
  <p>Footer</p>
</div>

<!--Footer End-->

</body>
</html>
