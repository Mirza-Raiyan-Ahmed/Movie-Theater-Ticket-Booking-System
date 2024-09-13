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
        background: #D3D3D3;
        float: left;
        color:black;
       
       
    }
    ul li{
        padding: 20px;
        border-bottom: 2px solid grey;
    }
    ul li:hover{
        background:#FFFFE0;
        color:white; 
    }
    a{
        text-decoration: none;
        color: white;
        font-size: 24px;
    }
    #data{
        
        height: auto;
        background: #F2F3F4;
        color: black;
        font-family: Helvetica;
        font-size: 18px;
        text-align: center;
       
        
        

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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Enter Movie id</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="number" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
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
                                        $query = "SELECT * FROM movies WHERE movie_id= $filtervalues";
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
 </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>


</html>