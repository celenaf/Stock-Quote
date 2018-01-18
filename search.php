<?php
	ob_start();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false); 
	header("Pragma: no-cache");
?>

<!DOCTYPE html>
 
<html>

	<head>
		<title>Search</title>
		<link rel="stylesheet" type="text/css" href="main3.css" />
	</head>

	<body>
		<?php 
		include("header1.php");
		require "dbUtil.inc";
		$objDBUtil = new DbUtil;
		error_reporting(0);
		?>
		
	<br>	
	
			<center>
		<div>
			<form name="symbol" action="quotes.php" method="get">
				<h3>Enter a company name:</h3><input type="text" name ="symbolname" value="<?php echo @$_REQUEST['symbolname']; ?>" >
				<input type="submit" class="button1" value="Search" onClick="symbol.action='search.php' ;" />
			</form>
		</div>
		</center>	
	
	<br>
	
	<?php
		$symbolname = @$_REQUEST['symbolname'];
	
		if(! empty($symbolname))
		{
			$db = $objDBUtil->Open();
			$query = "SELECT symSymbol, symName FROM symbols " . "WHERE symSymbol =" . $objDBUtil->DBQuotes($symbolname);
			$result = $db->query($query);

			
			if(! $result)
			{
				print "Invalid query result<br />\n"; 
			}
			else 
			{
				$row = @$result->fetch_assoc();
				print "Number of rows in result = " . $result->num_rows . "<br />\n";
				print "<b>Symbol:</b> " . $row['symSymbol'];
				print "<b>Company Name:</b> {$row['symName']}<br />\n"; 
			}	
				 @$result->free();	
			
		print "<br />\n";				
				 
		$result = $db->query($query);
		
		if(result)
		{
			
		}
		
		 @$result->free();		
		 $objDBUtil->Close();
		}
	?>
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<?php include("footer.php");
	ob_end_flush()?>	
	
	</body>
	
</html>