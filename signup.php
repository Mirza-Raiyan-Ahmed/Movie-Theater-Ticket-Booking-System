<?php

class Signup
{
    private $error = "";
    
    public function evaluate($data)
    {    
        
        foreach($data as $key => $value)
        {
            if(empty($value)){
                $this->error = $this->error . $key . " is empty!<br>";
            }
        }
        if($this->error == ""){
            //no error
            $this->create_user($data);
        }else{
            return $this->error;
        }
        
    } 
    public function create_user($data)
    {

        $name = $data['name'];
       
        $password = password_hash($data['password'], PASSWORD_DEFAULT) ;
        $email = $data['email'];
        $phone_number = $data['contact'];

        //$user_id = create_userid();
         

        $query = "insert into users (name, password, email, phone_number) values ('$name','$password','$email','$phone_number') ";
        
        $DB = new Database();
        $DB->save($query);
    }
    
}

?>