<?php

class Login_admin
{

    private $error = "";

    public function evaluate($data)
    {
        
		$email = addslashes($data['email']);
		$password = addslashes($data['password']);

		$query = "select * from admin where email = '$email' limit 1 ";

        $DB = new Database();
		$result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            //$password == $row['password']
            if(password_verify($password,$row['password']))
            {
                $_SESSION['movie_theater_admin_id'] = $row['admin_id'];

            }else
            {
                $this->error .= "wrong password<br>";
            }

        }else
        {
            $this->error .= "No such email was found<br>";  
            
        }
        
        return $this->error;
    }
    public function check_login($id)
	{
		$query = "select admin_id from admin where admin_id = '$id' limit 1 ";

		
		$DB = new Database();
		$result = $DB->read($query);
		
		if($result)
		{

			return true;
		}

		return false;

	}
}
