<?php
    include("classes/connect.php");

   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        error_reporting(0);

        $title= $_POST['title'];
        $time = $_POST['showtime1'];
        $time2 = $_POST['showtime2'];
        
        $query= "SELECT * from `movies` WHERE movie_title= '$title' ";
        $DB = new Database();
        $result =$DB->read($query);
        if($result)
        {
            $query = "UPDATE `movies` SET `showtime1`='$time',`showtime2`='$time2' WHERE movie_title='$title' ";

            $DB = new Database();
            $DB->save($query);
            
        
        
        }else{
            echo "<p align=center>(please enter the correct name) </p> ";
        }
    }
        

?>
<html>
    <head>

    </head>
    <title>Update Showtime</title>
        <link rel="stylesheet" href="manage_movie.css"/>
    <body>
    <div class="center">
    <form  method="POST" enctype="multipart/form-data" >

        <div class="txt_field">
        <input type="text" name="title">
          <span></span>
          <label>Movie title</label>
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

    
     

    <input type="submit" name="submit" value="Update Showtime">
    
    </form>
</div>
    </body>
</html>