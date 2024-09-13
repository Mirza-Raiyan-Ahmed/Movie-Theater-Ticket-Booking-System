<?php
session_start();
    include("classes/connect.php");
    include("classes/movie.php");
    include("classes/user.php");
    include("classes/login.php");
    


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {   
       

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

        $id = $_SESSION['movie_theater_user_id'];
        $login = new Login();
        $user = new User();
        $user_data = $user->get_data($id);
        $user_id=$user_data['user_id'];
        $username = $user_data['name'];

       // print_r($user_id);

        $payment = $_POST['payment_type'];
        $tickets = $_POST['tickets'];
        $hall = $_POST['hall'];
       
        $seat = $_POST['seat_type'];
        $time = $_POST['show_time'];
        $date = $_POST['date'];
        $tid=1;
        

        $movie_ticket = $movie_ticket - $tickets;
        if($movie_ticket <0){
            echo " no tickets left!";
            return;
        }else{
            $query  ="UPDATE movies SET `no_of_tickets`= $movie_ticket WHERE `movie_id` = $movie_id  ";
            $DB= new Database();
            $DB->save($query);
    
            $query = "INSERT INTO tickets (`movie_id`,`user_id`,`no_of_tickets`, `hall_number`, `seat_type`, `date`,`payment_method`) VALUES ($movie_id,$user_id,$tickets,'$hall','$seat','$date','$payment')";
             $DB = new Database();
            $result=$DB->save($query);
            if($result){
                echo "<p align=center>ticket booked successfully!</p>";
            }
            $query="SELECT * FROM tickets WHERE movie_id=$movie_id AND `user_id`=$user_id AND `date`='$date' ";
            $DB = new Database();
            $conn = $DB->connect();
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
             

            $query ="INSERT INTO booking (`ticket_id`,`user_id`,`payment_status`) VALUES ( $row[ticket_id] ,(SELECT `user_id` from users WHERE `user_id`=$user_id ),'$payment')";

            $DB = new Database();
            $result=$DB->save($query);
            if($result){
              //  echo "booking table done";
            }else{
               // echo "sth went wrong";
            }
    
        }
        
        
           
            
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>

#dropdown {
        height: 40px;
				width: 300px;
				border-radius: 4px;
				border:solid 1px #add8e6;
				padding: 4px;
				font-size: 14px;
  
}
</style>
<body>

<div class="center">
    <h1>Reserve</h1>
    <form  method="POST"  >

    <div class="txt_field">
    <input type="text" name="title">
          <span></span>
          <label>Movie title:</label>
        </div>
    
    
    
    Payment method<br>
    <select id="dropdown" name="payment_type"></br>
   
        <option>Cash</option>
        <option>Credit</option>
    </select>
    <br><br>
         
    
   
        <div class="txt_field">
        <input type="number" name="tickets">

          <span></span>
          <label>no_of_tickets:</label>
        </div>
        


   
    Hall number: <br>
    <select  id="dropdown" name="hall">
        <option>Hall-1</option>
        <option>Hall-2</option>
        <option>Hall-3</option>
    </select><br><br>
   
    
   
    Seat type <br>
    <select id="dropdown" name="seat_type"></br>
        <option>regular</option>
        <option>Premium</option>
    </select>
<br><br>
        
        
    
    Showtime:<br>
    
    <select name="show_time">
        
        <option><?php echo date('h:i A',strtotime('05:30 PM'));  ?></option>
        <option><?php echo date('h:i A',strtotime('02:00 PM'));  ?></option>
    </select>
    
        
    <div class="txt_field">
    <input type="date" name="date">
          <span></span>
          <label> Date:</label>
        </div>
   
    <input type="submit" name="submit" value="book ticket">
    
    </form>

</div>
</body>
</html>