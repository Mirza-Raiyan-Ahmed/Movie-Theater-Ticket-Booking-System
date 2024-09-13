<?php

class Admin{

    
 	public function get_data($id)
 	{

 		$query = "select * from admin where admin_id = '$id' limit 1";

 		$DB = new Database();
 		$result = $DB->read($query);

 		if($result)
 		{
 			$row = $result[0];
 			return $row;
 		}else
 		{
			return false;
 		}
 	}

 	public function get_admin($id)
 	{
 		$query = "select * from admin where admin_id = '$id' limit 1";

 		$DB = new Database();
 		$result = $DB->read($query);

 		if($result)
 		{
 			return $result[0];
 		}else
 		{
 			return false;
 		}
 	} 
}

