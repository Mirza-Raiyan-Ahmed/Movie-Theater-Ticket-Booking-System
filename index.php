<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/movie.php");
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
    <title>Home Page</title>

    <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 800px;
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
     
       
      </li>
      <li class="nav-item">
        <a class="nav-link " href="booking_beta.php">Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="user_logout.php">Logout</a>
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

  <!----search----->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Enter Movie name</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Movie Title</th>
                                    <th>Cover</th>
                                    <th>Genre</th>
                                    <th>Release Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   // $con = mysqli_connect("localhost","root","","phptutorials");
                                   $DB = new Database();
                                   $conn = $DB->connect();
                                  
                           
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM movies WHERE CONCAT(movie_title,genre,release_date) LIKE '%$filtervalues%' ";
                                        $result = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($result) > 0)
                                        {
                                            foreach($result as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $items['movie_title']; ?></td>
                                                    <td><img src="images/<?php echo $items['image'];?> " height=200px width=200px></td>
                                                    <td><?php  echo $items['genre']; ?></td>
                                                    <td><?php echo $items['release_date']; ?></td>
                                                   
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!------>

   <div class="container py-5">
    <div class ="row mt-4">

    <?php
        $query = "SELECT * FROM movies";
        
        $DB = new Database();
        $conn = $DB->connect();
        $result = mysqli_query($conn,$query);
        $check_movie= mysqli_num_rows($result);
        if($check_movie)
        {
            while($row = mysqli_fetch_array($result))
            {
                ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="images/<?php echo $row['image'];?>" class="card-img-top" alt="movie Images">
                                <h2 class="card-title"> <?php  echo $row['movie_title'];  ?> </h2>
                                <p class="card-text">
                                <?php  echo $row['genre'];?>
                                </p>
                                
                                
                            </div>

                        </div>
                    </div>

                <?php

               
            }
        }
        else
        {
            echo "no movies found";
        }

    ?>
        

    </div>
    
</div>
    


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>