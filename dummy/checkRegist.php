<?php

class checkRegist extends Db
{
    protected function getUsers()
    {
        $sql = "SELECT * FROM user";
        $result = $this->connect()->query($sql);
        $nR = $result->num_rows;

        if ($nR > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            return $data;
        }
    }
}

?>