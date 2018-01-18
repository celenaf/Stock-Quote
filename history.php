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
		<title>History</title>
		<link rel="stylesheet" type="text/css" href="main2.css" />
	</head>

	<body>
		<?php 
		include("header1.php");
		error_reporting(0);?>
	</br>
	
	<center>
		<div>
			<form name="symbol" action="quotes.php" method="get">
				<h3>Enter a symbol:</h3><input type="text" name ="symbolname" value="<?php echo $_REQUEST['symbolname']; ?>" >
				<input type="submit" class="button2" value="Get History" onClick="symbol.action='history.php' ;" />
				<input type="submit" class="button1" value="Get Quote" onClick="symbol.action='quotes.php' ;" />
			</form>
		</div>	
	<br>
	
	<div id = "historyTableInfoTitle1">
	<table>
	<?php
			$symbolname=$_REQUEST['symbolname'];
			
			if(! empty($symbolname))
			{
				$host = "cs.spu.edu";
				$user = "quotesdb";
				$pwd = "quotesdb";
			}
			
			$db = @new mysqli($host, $user, $pwd, 'quotesdb');
			
			if($db->connect_errno)   
				die(); 
			
			$query = "SELECT symSymbol, symName FROM symbols " . "WHERE symSymbol = '" . $symbolname ."'";
			
			$result=@$db->query($query);
			
			if(! $result)  
			{   
				print "Invalid query result<br />\n";  
			}  
			
			else  
			{   
				// Process row   
				$row = @$result->fetch_assoc();
				print "<tr>";
				print "<td><b><div style='text-align: left'>Company Name:</b> {$row['symName']}</div></td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td><b><div style='text-align: left'>Symbol is: <span style='color: blue'>{$row['symSymbol']}</span></div></b></td>";
				print "</tr>";
				$result->free();
			}  
	?>		
	</table>
	</div>
	
	<?php
			$query = "select qSymbol, qQuoteDateTime, qLastSalePrice, qNetChangePrice, qNetChangePct, qShareVolumeQty from quotes" . " where qSymbol='{$symbolname}'"    ." order by qQuoteDateTime desc";
			
			$result = @$db->query($query);  
			
			if(! $result)  
			{   
				print "Invalid query result<br />\n";  
			} 
	?>
	
	<div id = "historyTableInfoTitle2">
	<table>
	<?php
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "<td><b>Date</b></td>";

				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "<td><b>Last</b></td>"; 
				print "<td><b>Change</b></td>";
				print "<td><b>% Chg</b></td>"; 
				print "<td><b>Volume</b></td>";
				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "</tr>\n";
	?>
	</table>
	</div>
	
	<div id = "historyTableInfo">
	<table>
	<?php
			while($row = @$result->fetch_assoc())
			{   					
				$volumeNum = $row['qShareVolumeQty'];
				$formatedVolNum = number_format($volumeNum);
					
				$date = $row['qQuoteDateTime'];
					
				$last = $row['qLastSalePrice'];
					
				$change = $row['qNetChangePrice'];
					
				$changePct = $row['qNetChangePct'];
					
				print "<tr>";
				print "<td>$date</td>";
				print "<td>&nbsp;</td>";
				print "<td>" . number_format($last, 2) ."</td>";
				print "<td>&nbsp;</td>";
				print "<td>" . number_format($change, 2) . "</td>";
				print "<td>&nbsp;</td>";
				print "<td>&nbsp;</td>";
				print "<td>" . number_format($changePct, 2) ."</td>";
				print "<td>$formatedVolNum</td>";   
				print "<td>&nbsp;</td>";
				print "</tr>"; 
			}  
			
			print "</table>"; 
			
			$result->free(); 
	?>
	</table>
	</div>
	</center>
	
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<?php 
	@$result->data_seek(0); 
	@$db->close();
	include("footer.php");
	ob_end_flush()
	?>	
	
	</body>
	
</html>