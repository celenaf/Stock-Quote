<?php
	if(! empty($symbolname))
	{
		$host = "cs.spu.edu";
		$user = "quotesdb";
		$pwd = "quotesdb";
	}
			
	$db = @new mysqli($host, $user, $pwd, 'quotesdb');
			
	if($db->connect_errno)   
		die(); 
?>