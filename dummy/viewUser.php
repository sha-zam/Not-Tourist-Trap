<?php

class viewUser extends checkRegist
{
    public function showUsers()
    {
        $datas = $this->getUsers();

        foreach($datas as $data)
        {
            echo $data['UserID']."<br>";
            echo $data['Email']."<br>";
        }

    }
}

?>