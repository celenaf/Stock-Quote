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
		<title>Stock Center</title>
		<link rel="stylesheet" type="text/css" href="main.css" />
	</head>

	<body>
	<?php 
	include("header.php");
	error_reporting(0);
	?>
	
	<?php
		$symbolname=$_REQUEST['symbolname'];
	?>
		
	<br>
	<br>
	<br>
	<br>
	
	<h1 align="center"><img src="http://i1224.photobucket.com/albums/ee361/celeee96/stockCenterImageFinal_zpssajkawtl.png"></h1>
	
	</br>
		
		<center>
		<div>
			<form name="symbol" action="quotes.php" method="get">
				<h3>Enter a symbol to get a quick quote:</h3><input type="text" name ="symbolname" value="<?php echo $_REQUEST['symbolname']; ?>" >
				<input type="submit" class="button1" value="Get Quote" onClick="symbol.action='quotes.php' ;" />
				<input type="submit" class="button2"value="Get History" onClick="symbol.action='history.php' ;" />
				<p style="font-size: 10">Not sure about the company symbol?</p>
				<input type="submit" class="button1" value="Search" onClick="symbol.action='search.php' ;" />
			</form>
		</div>
		</center>	
		
	<br/>
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

