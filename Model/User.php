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
    private $profileImg;
    private $lang = array();

    
    public function __construct($email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        $this->email = $email;
        $this->pwd = $pwd;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->profileImg = $profileImg;

        if (count($lang) > 0)
        {
            for($i = 0; $i < count($lang); $i++)
            {
                $this->lang[$i] = $lang[$i];
            }
        }
        else
        {
            for($i = 0; $i < count($lang); $i++)
            {
                $this->lang[$i] = '';
            }
        }
        
    }
    
    //construct using only userID
    public function withID($id)
    {
        $user = new self('','','','','',array());
        $user->loadByID($id);
        return $user;   
    }
    
    public function loadByID($id)
    {
        $this->userID = $id;
    }

    protected static function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "csit314";

        $conn = new mysqli($servername, $username, $password, $dbname);

        return $conn;
    }
    
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

    public function getProfileImg()
    {
        return ($this->profileImg);
    }

    //Login function
    public function checkLogin()
    {
        $conn = $this->connect(); //create connection

        //query
        $this->pwd = md5($this->pwd);

        $query = "SELECT * from user WHERE Email='$this->email' and Password='$this->pwd'";

        $check = $conn->query($query);
        $count_row = $check->num_rows;

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
                $this->profileImg = $x['Profile_Image'];
            }

            //get language ID
            $langQ = "SELECT LanguageID FROM spokenlanguage WHERE UserID = '$this->userID'";
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
    public function Regist()
    {
        //create connection
        $conn = $this->connect(); 

        $query = "SELECT * from user WHERE Email='$this->email' and Password='$this->pwd'";

        $check = $conn->query($query);
        $count_row = $check->num_rows;

        if($count_row == 0)//Check whether user already exists 
        {
            //md5 pwd
            $this->pwd = md5($this->pwd);

            //query to insert user 
            $sql1 = "INSERT INTO user (FirstName,LastName,Email,Password,Profile_Image) VALUES ('$this->fName','$this->lName','$this->email','$this->pwd','$this->profileImg')"; 
            $insertUser = $conn->query($sql1);

            $last_uid = $conn->insert_id;

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
    
    public function updateFName($fName)
    {
        $conn = $this->connect(); //create connection
        
        $query = "update User set FirstName = '$fName' where UserID = $this->userID";
        
        $conn -> query($query);
    }
    
    public function updateLName($lName)
    {
        $conn = $this->connect(); //create connection
        
        $query = "update User set LastName = '$lName' where UserID = $this->userID";
        
        $conn -> query($query);
    }
    
    public function updateEmail($email)
    {
        $conn = $this->connect(); //create connection
        
        $query = "update User set Email = '$email' where UserID = $this->userID";
        
        $conn -> query($query);
    }
    
    public function updatePassword($password)
    {
        $pwd = md5($password);
        $conn = $this->connect(); //create connection
        
        $query = "update User set Password = '$pwd' where UserID = $this->userID";
        
        $conn -> query($query);
    }
    
    public function updateProfilePic($profilePic)
    {
        $conn = $this->connect(); //create connection
        
        $query = "update User set Profile_Image = '$profilePic' where UserID = $this->userID";
        
        $conn -> query($query);
    }

    public function updateLanguages($lang)
    {
        $conn = $this->connect(); //create connection
        
        $query = "delete from SPOKENLANGUAGE where UserID = $this->userID";
        
        $conn -> query($query);
        
        for ($i = 0; $i < 3; $i++)
        {
            $temp = $lang[$i];

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

                //insert into spoken language
                $spkQ = $conn->query("INSERT INTO spokenlanguage (UserID, LanguageID) VALUES ('$this->userID', '$langID')");
            }
        }
    }
}

?>