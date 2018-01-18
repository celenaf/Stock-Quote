<?php
class DbUtil
{
	public $db = NULL;
	
	//DB Connection Parameters: Modify for specific project
	public $host 		= "cs.spu.edu";
	public $user 		= "quotesdb";
	public $pwd 		= "quotesdb";
	public $defaultDB 	= "quotesdb";

	function __construct() // constructor - not needed for DbUtil 
	{		}
	
	function Open($useDB="")
	{
		if ($this->db == NULL)
		{
			if($useDB != "")
				$this->defaultDB = $useDB;
				
			$this->db = @new mysqli($this->host, $this->user, $this->pwd, $this->defaultDB);

			if($this->db->connect_errno)
				die("Could not connect to database. " . "Error[{$this->db->connect_errno}]");
		}
		elseif (($useDB != "") && ($useDB != $this->defaultDB))
		{
			$this->defaultDB = $useDB; 
			@$this->db->select_db($this->defaultDB);
		}
        return $this->db;
	}
	
	function Close() 
	{
	
		if ($this->db != NULL) 
		{
            @$this->db->close();
            $this->db = NULL;
        }
	}

	function DBQuotes($strSQL)
	{
       if(! get_magic_quotes_gpc())
			return "'" . addslashes($strSQL) . "'";
			
       return "'" . $strSQL . "'";
    }
}
?>