<?php
class Movie
{
    public function get_movie($title)
 	{
 		$query = "select * from movies where movie_title = '$title' limit 1";

 		$DB = new Database();
 		$result = $DB->read($query);
		

 		if($result)
 		{	
			 $_SESSION['movie_theater_movie_title'] = $title;
 			return $result[0];
 		}else
 		{
 			return false;
 		}
 	} 
}
?>