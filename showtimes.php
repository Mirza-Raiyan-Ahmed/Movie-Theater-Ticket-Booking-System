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
                header("Location: login_beta.php");
                die;
            }


        }else
        {
            header("Location: login_beta.php");
            die;
        }
    }else
    {
        header("Location: login_beta.php");
        die;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 800px;
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
  </style>

</head>
<body>
   <header>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Welcome to Movie Theater</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_booking.php">My Tickets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="showtimes.php">Showtimes</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link " href="booking_beta.php">Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="user_logout.php">Logout</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    
  </div>
</nav>


<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/slider1.jpg" alt="Los Angeles" width="1100" height="300">
    </div>
    <div class="carousel-item">
      <img src="images/slider2.jpg" alt="Chicago" width="1100" height="300">
    </div>
    <div class="carousel-item">
      <img src="images/slider3.jpg" alt="New York" width="1100" height="300">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
   </header>

   <div id="data">
     <br><br>
     <table class="movie-table">
    <thead>
    <tr>
        
        <th>Cover</th>
        <th>Movie Title</th>
        <th>Showtime 1</th>
        <th>Showtime 2</th>
    </tr>
    </thead>
    <?php
        $query = "SELECT * FROM movies";
        
        $DB = new Database();
        $conn = $DB->connect();
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){
            ?>
                    <tbody>
                    <tr>
                    
                    <td><img src="images/<?php echo $row['image'];?> " height=200px width=200px></td>
                    <td><?php echo $row['movie_title']; ?></td>
                    <td><?php echo date('h:i A',strtotime($row['showtime1'])); ?></td>
                    <td><?php echo date('h:i A',strtotime($row['showtime2'])); ?></td>
                    </tr>
                </tbody>
             <?php   
            }
            ?>
         <?php   
        }
    ?>



    </div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>