<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");

    if( isset($_SESSION['movie_theater_user_id']) ) 
    {

        $id = $_SESSION['movie_theater_user_id'];
        $login = new Login();
        
        $result = $login->check_login($id);
        if($result)
        {   
            $user = new User();
            
            $user_data = $user->get_data($id);
           

            if(!$user_data)
            {
                header("Location: login.php");
                die;
            }


        }else
        {
            header("Location: login.php");
            die;
        }
    }else
    {
        header("Location: login.php");
        die;
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title> HOME PAGE</title>
        <style>
            body{
                margin: 0px;
                border: 0px;
            }
            #header{
                width: 100%;
                height: 200px;
                background:#3c5a99;
                color: white;
                padding: 2px;
            }
            .logout-button{
                float:right;
				width: 80px;
				height: 40px;
                margin-top: -50;
                margin-right: 10px;
                padding-top: 10px;
				border-radius: 8px;
				font-weight: bold;
				border: none;
				background-color: #009879;
				color: white;
                text-align: center;

			
			}
            a{
                text-decoration: none;
                color: white;
            }
            .cancel-button{
                float:left;
				width: 120px;
				height: 70px;
                margin-top: -50;
                margin-right: 10px;
                padding-top: 10px;
				border-radius: 8px;
				font-weight: bold;
				border: none;
				background-color: #009879;
				color: white;
                
                text-align: center;

			
			}
            
        </style>
        <body>

            <div id="header">
             
             <h1><center>WELCOME TO MOVIE THEATER</br><br><?php echo "USERNAME: ". $_SESSION['movie_theater_username'] ?><center></h1>
             <div class="cancel-button">
            <a href="cancel_ticket.php">cancel Ticket</a>
        </div>
             <div class="logout-button">
            <a href="user_logout.php">Logout</a>
            </div>
            </div>
            <div class="row align-items-center">
            <div class="container">
            <table class="table">
  <thead>
    <tr>
        <th>Ticket id</th>
        <th>Movie Title</th>
        <th>Movie Genre</th>
        <th>Hall Number</th>
        <th>Seat Type</th>
        <th>Time</th>
        <th>Date</th>
        
    </tr>
  </thead>
  <tbody>
  <?php
  $user=$_SESSION['movie_theater_user_id'];
        $query = "select * from tickets t inner join users u on t.user_id = u.user_id inner join movies m on t.movie_id = m.movie_id where u.user_id='$user'";
        
        $DB = new Database();
        $conn = $DB->connect();
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){
            ?>  
                    <tr>
                     <td><?php echo $row['ticket_id']?></td>   
                    <td><?php echo $row['movie_title']; ?></td>
                    <td><?php echo $row['genre']; ?></td>
                    <td><?php echo $row['hall_number']; ?></td>
                    <td><?php echo $row['seat_type']; ?></td>
                    <td><?php echo date('h:i A',strtotime($row['showtime1'])); ?></td>
                    <td><?php echo $row['date']; ?></td>
                    
                    </tr>
                
             <?php   
            }
            ?>
         <?php   
        }
    ?>


  </tbody>
</table>
</div>
        </div>
            
            
            

        </body>
    </head>
</html>