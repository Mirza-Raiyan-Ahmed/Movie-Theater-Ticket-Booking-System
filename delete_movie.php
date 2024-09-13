<?php
    include("classes/connect.php");

   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $count=0;
        error_reporting(0);
        $title = $_POST['title'];
        
        $query = "DELETE FROM movies where movie_title = '$title' ";
        
        
            $DB = new Database();
            $DB->save($query);
        
        
        
    }

?>
<html>
    <head>
    <title>Delete Movies</title>
    </head>
    <style>
     
        .movie-table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            
            font-size: 1.3em;
            min-width: 880px;;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            float:right;
        }
        .movie-table  thead tr{
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }
        .movie-table th,
        .movie-table td {
            padding: 12px 15px;
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
        .center{
                position: absolute;
                top: 50%;
                left: 25%;
                transform: translate(-50%, -50%);
                width: 400px;
                background: white;
                border-radius: 10px;
                border-style: solid;
                border-color: black;
               
                }
                .center h1{
                text-align: center;
                padding: 20px 0;
                border-bottom: 1px solid silver;
                }
                .center form{
                padding: 0 40px;
                box-sizing: border-box;
                }
                form .txt_field{
                position: relative;
                border-bottom: 2px solid #adadad;
                margin: 30px 0;
                }
                .txt_field input{
                width: 100%;
                padding: 0 5px;
                height: 40px;
                font-size: 16px;
                border: none;
                background: none;
                outline: none;
                }
                .txt_field label{
                position: absolute;
                top: 50%;
                left: 5px;
                color: #adadad;
                transform: translateY(-50%);
                font-size: 16px;
                pointer-events: none;
                transition: .5s;
                }
                .txt_field span::before{
                content: '';
                position: absolute;
                top: 40px;
                left: 0;
                width: 0%;
                height: 2px;
                background: #2691d9;
                transition: .5s;
                }
                .txt_field input:focus ~ label,
                .txt_field input:valid ~ label{
                top: -5px;
                color: #2691d9;
                }
                .txt_field input:focus ~ span::before,
                .txt_field input:valid ~ span::before{
                width: 100%;
                }

        input[type="submit"]{
            width: 200px;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            }
            input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
            }
            .back{
                height:150%;
                width:1000px;
                background: hsl(149,50%,50%);
                float:left;
            }
    </style>
    <body>
<div class="center">
    <h1>Delete Movie</h1>
    <form  method="POST">
        <div class="txt_field">
        <input type="text" name="title">
            <span><span>
            <label></label>
        </div>
     
    

    <input type="submit" name="submit" value="Delete Movie">
    
    </form>
    </div>
    <div class="back">
    </div>
<div>
    <table class="movie-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Cover</th>
        <th>Movie Title</th>
        
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
                    <td><?php echo $row['movie_id']; ?></td>
                    <td><img src="images/<?php echo $row['image'];?> " height=200px width=200px></td>
                    <td><?php echo $row['movie_title']; ?></td>
                    
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