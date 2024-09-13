<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/movie.php");

   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $count=0;
        error_reporting(0);

        $userid=$_SESSION['movie_theater_user_id'];
       // print_r($userid);
        $ticket_id = $_POST['id'];

        $title = $_POST['title'];
        
        $movie = new Movie();
        $movie_data = $movie->get_movie($title);
        if($movie_data == false)
        {
            echo "No movie by that name";
           return;
        }
       //print_r($movie_id);
       $movie_id=$movie_data['movie_id'];
       $movie_ticket=$movie_data['no_of_tickets'];
       
       
        $date = $_POST['date'];
       // print_r($date);
      
       $query="SELECT * FROM tickets WHERE ticket_id=$ticket_id";
       $DB = new Database();
       $conn = $DB->connect();
       $result = mysqli_query($conn,$query);
       $row = mysqli_fetch_array($result);

       $new_ticket_no=$movie_ticket + $row['no_of_tickets']; // if cancelled increase that ticket number
       


        $query = "DELETE FROM `tickets` WHERE ticket_id=$ticket_id AND movie_id=$movie_id AND `user_id`=$userid AND `date`='$date'";
        
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
            $result=$DB->save($query);

            if($result){
                echo "canceled ticket successfully";

                $query="UPDATE `movies` SET no_of_tickets=$new_ticket_no WHERE movie_id=$movie_id";
                
                $DB = new Database();
             $result=$DB->save($query);

            }else{
                echo "please enter the correct information";
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
    <title>Cancel Ticket</title>
        <link rel="stylesheet" href="manage_movie.css"/>
    <body>
    <div class="center">
    <form  method="POST"  >
    <div class="txt_field">
            <input type="text" name="id">
          <span></span>
          <label>Ticket ID:</label>
    </div>
    <div class="txt_field">
            <input type="text" name="title">
          <span></span>
          <label>Movie Title:</label>
    </div>
    
    
        <div class="txt_field">
        <input type="date" name="date">
          <span></span>
          <label>date:</label>
        </div>
        
 
    <input type="submit" name="submit" value="Cancel ticket">
    
    </form>
</div>
    </body>
</html>