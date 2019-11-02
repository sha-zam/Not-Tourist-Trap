<?php

///memory limit setting
ini_set("memory_limit", "1024M");

//User Entity Class
class User
{
    private $email;
    private $pwd;
    private $fName;
    private $lName;
    private $userID;
    private $lang = array();

    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function __construct($email, $pwd, $fName, $lName, $lang)
    {
        $this->email = $email;
        $this->pwd = $pwd;
        $this->fName = $fName;
        $this->lName = $lName;

        for($i = 0; $i < count($lang); $i++)
        {
            $this->lang[$i] = $lang[$i];
        }
    }

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "csit314";

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }

    //Mutators (to be added later , possibly in a different entity)
    // public function setEmail($email)
    // {
    //     $this->email = $email;
    // }

    // public function setPwd($pwd)
    // {
    //     $this->pwd = md5($pwd);
    // }

    // public function setFName($fName)
    // {
    //     $this->fName = $fName;
    // }

    // public function setLName($lName)
    // {
    //     $this->lName = $lName;
    // }

    //Accessors (to be added later)
    public function getUserID()
    {
        return ($this->userID); 
    }

    public function getEmail()
    {
        return ($this->email);
    }

    public function getfName()
    {
        return ($this->fName);
    }

    public function getlName()
    {
        return ($this->lName);
    }

    public function getLangs()
    {
        return ($this->lang);
    }

    public function getPwd()
    {
        return ($this->pwd);
    }

    //Login function
    protected function checkLogin()
    {
        echo "<script type='text/javascript'>alert('checking $this->email and $this->pwd')</script>";

        $conn = $this->connect(); //create connection

        $query = "SELECT * from user WHERE Email='$this->email' and Password='$this->pwd'";

        $check = $conn->query($query);
        $count_row = $check->num_rows;

        echo "<script type='text/javascript'>alert('$count_row')</script>";

        if($count_row > 0) 
        {
            //return userID, fName, lName
            while($row = $check->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                $this->fName = $x['FirstName'];
                $this->lName = $x['LastName'];
                $this->userID = $x['UserID'];
            }

            echo "<script type='text/javascript'>alert('user full name = $this->fName $this->lName', user id = $userID)</script>";

            //get language ID
            $langQ = "SELECT LanguageID FROM spokenlanguage WHERE UserID = $userID";
            $langQ_result = $conn->query($langQ);

            if ($langQ_result->num_rows > 0) //if any language exists
            {
                while($langRow = $langQ_result->fetch_assoc())
                {
                    $langData[] = $langRow;
                }

                $i = 0;

                foreach($langData as $x2)
                {
                    $langID = $x2['LanguageID'];

                    //get language name
                    $langQ2 = "SELECT Name FROM language WHERE LanguageID = $langID";
                    $langQ2_result = $conn->query($langQ2);

                    while($langNameRow = $langQ2_result->fetch_assoc())
                    {
                        $langNameData[] = $langNameRow;
                    }

                    foreach($langNameData as $x3)
                    {
                        $this->lang[$i] = $x3['Name'];
                    }

                    $i++;
                }

            }
            

            return $this;

        }
        else
        {
            return false;
        }
    }

    //Register function (echoes to be removed later)
    protected function Regist()
    {
        echo "<script type='text/javascript'>alert('regist $this->email and $this->pwd')</script>";

        //create connection
        $conn = $this->connect(); 

        $query = "SELECT * from user WHERE Email='$this->email' and Password='$this->pwd'";

        $check = $conn->query($query);
        $count_row = $check->num_rows;

        echo "<script type='text/javascript'>alert('$count_row')</script>";

        if($count_row == 0)//Check whether user already exists 
        {
            //query to insert user 
            $sql1 = "INSERT INTO user (FirstName,LastName,Email,Password) VALUES ('$this->fName','$this->lName','$this->email','$this->pwd')"; 
            $insertUser = $conn->query($sql1);

            $last_uid = $conn->insert_id;

            echo "<script type='text/javascript'>alert('last id : $last_uid')</script>";

            //query for languageID 
            for ($i = 0; $i < 3; $i++)
            {
                $temp = $this->lang[$i];

                if ($temp != "none") //If user does not leave language blank 
                {
                    $langQ = $conn->query("SELECT LanguageID FROM language WHERE Name='$temp'");
   
                    while($row = $langQ->fetch_assoc())
                    {
                        $data[] = $row;
                    }

                    foreach($data as $x)
                    {
                        $langID = $x['LanguageID'];
                    }

                    echo "<script type='text/javascript'>alert('insert : $temp id $langID')</script>";

                    //insert into spoken language
                    $spkQ = $conn->query("INSERT INTO spokenlanguage (UserID, LanguageID) VALUES ('$last_uid', '$langID')");
                }
            
            }
            
            $conn->close();

            return true;

        }
        else
        {
            $conn->close();

            return false;
        }
    }

}

?>