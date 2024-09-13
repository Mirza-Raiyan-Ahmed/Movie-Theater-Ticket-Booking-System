<?php
    include("classes/connect.php");

   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $count=0;
        error_reporting(0);

        $image = $_FILES['image']['name'];
        $target = "images/".basename($image);
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $release_date = $_POST['date'];
        $no_of_tickets = $_POST['tickets'];
        $time = $_POST['showtime1'];
        $time2 = $_POST['showtime2'];
       
        $query = "INSERT INTO `movies`(`movie_title`, `image`,`genre`, `release_date`, `no_of_tickets`,`showtime1`,`showtime2`) VALUES ('$title','$image','$genre','$release_date','$no_of_tickets','$time','$time2')";
        
        foreach($_POST as $key => $value)
        {
            if(empty($value)){
               $count = $count + 1;
               echo $key . " is empty!<br>";
            }
        }
        if($count == 0)
        {
            $DB = new Database();
            $DB->save($query);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
                echo "<p align=center> Movie added successfully </p>";
            }else{
                $msg = "Failed to upload image";
            }
        }else
        {
            echo "Please fill up all the boxes";   
        }
        
    }

?>
<html>
    <head>

    </head>
    <title>Add Movies</title>
        <link rel="stylesheet" href="manage_movie.css"/>
    <body>
    <div class="center">
    <form  method="POST" enctype="multipart/form-data" >
    <div class="txt_field">
            <input type="text" name="title">
          <span></span>
          <label>Movie Title:</label>
    </div>
    <div class="cover">
    Cover picture: <input type="file" name="image" id="image" ><br></br>
    <span></span>
    </div>
    <div class="txt_field">
        <input type="text" name="genre">
          <span></span>
          <label>Genre</label>
        </div>
        <div class="txt_field">
        <input type="date" name="date">
          <span></span>
          <label>Release date:</label>
        </div>
        <div class="txt_field">
        <input type="number" name="tickets">
          <span></span>
          <label>Number of Tickets:</label>
        </div>
        <div class="txt_field">
        <input type="time" name="showtime1">
          <span></span>
          <label>Showtime 1</label>
        </div>
        <div class="txt_field">
        <input type="time" name="showtime2">
          <span></span>
          <label>Showtime 2</label>
        </div>

    
     

    <input type="submit" name="submit" value="Add Movie">
    
    </form>
</div>
    </body>
</html>