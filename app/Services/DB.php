<?php

class DB
{
    public static $dbInstance;
    public $con;
    private $_query;
    private $results;

    public function __construct()
    {
        $HOST = 'localhost';
        $USER = 'root';
        $DBNAME = 'iChurch';
        $PASSWORD = '';
        //sql connection to db
        
        if ($this->con = mysqli_connect($HOST, $USER, $PASSWORD))
        {
            $sql = "CREATE DATABASE IF NOT EXISTS $DBNAME";
            if (!$this->query($sql))
            {
                # code...
                die('Could Not Create Database'. mysqli_error());
            }
            else
            {
                //select the database
                $this->SelectDB($DBNAME);
            }
        }
        else
        {
            die('Failed to Connect to Sever'. mysqli_error());
        }
    }

    private function SelectDB($dbname)
    {
        if (mysqli_select_db($this->con, $dbname))
        {
            # code...
            return true;
        }
    }

    public function getLastId($sql)
    {
        $this->results = mysql_insert_id($this->con,$sql);
			return $this->results;
    }

    public static function DBInstance()
    {
        if (!isset(self::$dbInstance))
        {
            self::$dbInstance = new DB();
        }
        return self::$dbInstance;
    }

    public function query($sql)
    {
        if($this->_query = mysqli_query($this->con, $sql))
        {
            return $this;
        }
        else
        {
            return false;
        }
    }

    public function getResults()
    {
        $this->results = mysqli_fetch_assoc($this->_query);
        return $this->results;
    }

    public function isExist()
    {
        $this->results = mysqli_num_rows($this->_query);
        if($this->results > 0)
        {
            return true;
        }
        return false;
    }
}