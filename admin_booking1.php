<?php
session_start();
include("classes/connect.php"); 
include("classes/login_admin.php");
include("classes/admin.php");

    if( isset($_SESSION['movie_theater_admin_id']) )
    {

        $id = $_SESSION['movie_theater_admin_id'];
        $login = new Login_admin();
        
        $result = $login->check_login($id);
        if($result)
        {   
            $admin = new Admin();
            
            $admin_data = $admin->get_data($id);

            if(!$admin_data)
            {
                header("Location: login_admin.php");
                die;
            }


        }else
        {
            header("Location: login_admin.php");
            die;
        }
    }else
    {
        header("Location: login_admin.php");
        die;
    }

?>


<html>
    <head>
        <title> Welcome to Admin Panel </title>
    <style>
    body{
        margin: 0px;
        border: 0px;
    }
    #header{
        width: 100%;
        height: 100px;
        background-color: hsl(218,75%,50%);
        color: white;
        padding: 2px;
    }
    #sidebar{
        
        width: 300px;
        height: 150%;
        background: #512da8;
        float: left;
       
    }
    #data{
        height: auto;
        background: #F2F3F4;
        color: black;
        font-family: Helvetica;
        font-size: 18px;
        text-align: center;
       
        
        

    }
    ul li{
        padding: 20px;
        border-bottom: 2px solid grey;
    }
    ul li:hover{
        background:#8bc34a;
        color:white; 
    }
    a{
        text-decoration: none;
        color: white;
        font-size: 24px;
    }
    .movie-table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            
            font-size: 1.3em;
            min-width: 1200px;;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }
        .movie-table  thead tr{
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }
        .movie-table th,
        .movie-table td {
            padding: 15px 20px;
        }

        .movie-table tbody tr{
            border-bottom: 1px solid #dddddd;
        }
        .movie-table tbody tr:nth-of-type(even){
            background-color: #f3f3f3;
        }

        .movie-table tbody tr:last-of-type{
            border-bottom: 2px solid #009879;
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
           

    </style>
    </head>

    <body>
    <div id="header">
        <h1><center> ADMIN <center></h1>
        
        <div class="logout-button">
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>

    <div id="sidebar">
    <ul>
        <li><a href="add_movie.php" target="blank">   Add Movie  </a></li>
        <li> <a href="delete_movie.php" target="blank"> Delete Movie</a> </li>
        <li><a href="update_showtime.php" target="blank">  Update showtime</a>  </li>
        <li><a href="admin_booking1.php" target="blank">  User Bookings</a>  </li>
        <li><a href="search_movie.php" target="blank">  Search Movie</a>  </li>
    </ul>
    </div>

            





    <div id="data">
     <br><br>
     <table class="movie-table">
    <thead>
    <tr>
    <th>User Name</th>
        <th>Contact Number</th>
        <th>Hall Number</th>
        <th>Seat Type</th>
        <th>Time</th>
        <th>Time2</th>
        <th>Movie Title</th>
        <th>Movie Genre</th>
    </tr>
    </thead>
    <?php
        $query ="select * from (select b.ticket_id,t.hall_number,t.seat_type,movie_id,u.name,u.phone_number from booking b inner join tickets t on b.ticket_id = t.ticket_id inner join users u on b.user_id=u.user_id) a inner join movies m on m.movie_id=a.movie_id";
        
        $DB = new Database();
        $conn = $DB->connect();
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){
            ?>
                      <tbody> 
                    <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['hall_number']; ?></td>
                    <td><?php echo $row['seat_type']; ?></td>
                    <td><?php echo date('h:i A',strtotime($row['showtime1'])); ?></td>
                    <td><?php echo date('h:i A',strtotime($row['showtime2'])); ?></td>
                    <td><?php echo $row['movie_title']; ?></td>
                    <td><?php echo $row['genre']; ?></td>
                    </tr>
                </tbody>
             <?php   
            }
            ?>
         <?php   
        }
    ?>



    </div>
    </body>


</html>