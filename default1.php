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
	<?php include("header.php");?>
		
	<br>
	<br>
	<br>
	<h1 align="center"><img src="http://i1224.photobucket.com/albums/ee361/celeee96/stockCenterImageFinal_zpssajkawtl.png"></h1>
	
	</br>
		<div>
				<center><h3>Enter a symbol to get a quick quote:</h3></center>
				<p align = "center"><input type="text" name="search Quote"> 
				<a href="quotes.php" class="button1"> Get Quote!</a>
				<a href="quotes.php" class="button1"> Get History!</a>
				</p>
		</div>
		
		<center>
		<div>
			<form name="symbol" action="quotes.php" method="post">
				<input type="text" name ="symbol" placeholder="Enter Company Symbol..." value = "">
				<button type="submit" onClick="getAQuickQuote.action='quotes.php';">Get Quote!</button>
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
	<br>
	<br>
	<br>
	
	<?php include("footer.php");?>	
	
	</body>
	
</html>